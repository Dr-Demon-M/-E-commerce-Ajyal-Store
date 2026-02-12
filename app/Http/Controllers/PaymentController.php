<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    /**
     * Create ONE payment for MULTIPLE orders
     */
    public function createStripeSession(Request $request)
    {
        $orderIds = collect(explode(',', $request->orders))
            ->filter()
            ->map(fn($id) => (int) $id);

        if ($orderIds->isEmpty()) {
            abort(400, 'No orders provided');
        }

        $orders = Order::whereIn('id', $orderIds)
            ->where('payment_status', 'pending')
            ->get();

        if ($orders->count() !== $orderIds->count()) {
            abort(400, 'Invalid orders');
        }

        $total = $orders->sum('total');

        /** 1️⃣ Create Payment */
        $payment = Payment::create([
            'amount'   => $total,
            'currency' => 'EGP',
            'status'   => 'pending',
            'provider' => 'stripe',
        ]);

        /** 2️⃣ Attach payment to orders */
        Order::whereIn('id', $orderIds)->update([
            'payment_id' => $payment->id,
        ]);

        /** 3️⃣ Create Stripe Checkout Session */
        $stripe = new StripeClient(config('services.stripe.secret_key'));

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'EGP',
                    'product_data' => [
                        'name' => 'Multi-Store Order Payment',
                    ],
                    'unit_amount' => (int) round($total * 100),
                ],
                'quantity' => 1,
            ]],

            /** 🔑 Payment knows ALL orders */
            'metadata' => [
                'payment_id' => $payment->id,
            ],

            'success_url' => route('checkout.success'),
            'cancel_url'  => route('home'),
        ]);

        /** 4️⃣ Save Stripe reference */
        $payment->update([
            'provider_reference' => $session->id,
            'transaction_data' => [
                'checkout_session_id' => $session->id,
                'payment_intent'      => $session->payment_intent,
            ],
        ]);

        return redirect()->away($session->url);
    }

    /**
     * Webhook = Source of truth
     */
    public function handleStripeWebhook(Request $request)
    {
        /** 1️⃣ Verify signature */
        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                config('services.stripe.webhook_secret')
            );
        } catch (\Throwable $e) {
            Log::warning('Stripe webhook verification failed');
            return response('Invalid signature', Response::HTTP_BAD_REQUEST);
        }

        /** 2️⃣ We only care about success */
        if ($event->type !== 'checkout.session.completed') {
            return response('Ignored', Response::HTTP_OK);
        }

        $session = $event->data->object;
        $paymentId = $session->metadata->payment_id ?? null;
        Log::info('Stripe checkout completed', [
            'session_id' => $session->id,
            'payment_id' => $paymentId,
        ]);

        if (!$paymentId) {
            Log::error('Stripe webhook missing payment_id');
            return response('Missing metadata', Response::HTTP_BAD_REQUEST);
        }

        /** 3️⃣ Finalize payment + orders safely */
        DB::transaction(function () use ($paymentId) {

            $payment = Payment::lockForUpdate()->find($paymentId);
            if ($payment->status === 'paid') {
                return;
            }
            if (!$payment || $payment->status !== 'pending') {
                return;
            }

            /** Mark payment paid */
            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            /** Mark ALL related orders paid */
            $orders = Order::where('payment_id', $payment->id)->get();

            foreach ($orders as $order) {
                $order->update(['payment_status' => 'paid']);
                event(new OrderCreated($order));
            }

            /** Empty cart AFTER success */
            Cart::empty();
        });
        return response('Webhook handled', Response::HTTP_OK);
    }
}
