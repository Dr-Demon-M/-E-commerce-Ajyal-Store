@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-shopping-bag text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Order Details #{{ $order->id }}</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-list mr-2"></i> Order Items</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="pl-4">Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th class="text-right pr-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- افترضنا وجود علاقة products في موديل Order --}}
                                    @foreach ($order->products as $item)
                                        <tr>
                                            <td class="pl-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->image_url }}" class="rounded mr-2" width="40"
                                                        height="40" style="object-fit: cover;">
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ currency($item->order_item->price) }}</td>
                                            <td>x {{ $item->order_item->quantity }}</td>
                                            <td class="text-right pr-4 fw-bold text-primary">
                                                {{ currency($item->order_item->price * $item->order_item->quantity) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold mb-0">Grand Total:</h5>
                            <h5 class="fw-bold text-success mb-0">{{ currency($order->total, 'USD') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small">Status & Payment</h6>

                        <div class="mb-3">
                            <label class="small text-muted d-block">Order Status</label>
                            <span class="badge {{ $order->StatusBadgeClass() }} px-3 py-2 rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted d-block">Payment Status</label>
                            <span class="fw-bold {{ $order->paymentColor() }}">
                                <i class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>

                        <div class="mb-0">
                            <label class="small text-muted d-block">Payment Method</label>
                            <span class="fw-bold text-dark"><i class="fas fa-credit-card mr-1"></i>
                                {{ strtoupper($order->payment_method) }}</span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small">Customer Info</h6>
                        <p class="mb-1 fw-bold text-dark">
                            {{ $order->shippingAddress->name }}</p>
                        <p class="mb-1 small text-muted"><i
                                class="fas fa-envelope mr-1"></i>{{ $order->shippingAddress->email ?? 'N/A' }}</p>
                        <p class="mb-1 small text-muted"><i
                                class="fas fa-phone-alt mr-1"></i>{{ $order->shippingAddress->phone_number ? $order->billingAddress->phone_number : 'N/A' }}</p>
                        <hr>
                        <h6 class="text-uppercase text-muted fw-bold mb-2 small">Shipping Address</h6>
                        <p class="small text-secondary mb-0">
                            {{ $order->shippingAddress->street_address ?? 'No street address provided' }}</p>
                        <p class="small text-secondary mb-0">{{ $order->shippingAddress->city ?? 'No city provided' }}</p>
                        <p class="small text-secondary mb-0">
                            {{ $order->shippingAddress->governorate ?? 'No country provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 pb-2 d-flex gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary px-4">
                <i class="fas fa-arrow-left mr-1"></i> Back to Orders
            </a>
            <button class="btn btn-primary px-4 shadow-sm" onclick="window.print()">
                <i class="fas fa-print mr-1"></i> Print Invoice
            </button>
        </div>
    </div>
@endsection
