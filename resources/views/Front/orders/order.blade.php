<x-front-layout title="Order Details">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div>
                    <x-alert2 />
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title" style="font-size: 1.5rem;">Order Details #{{ $order->number }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('user.orders.index') }}">Orders</a></li>
                            <li>Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card border-0 shadow-lg mb-4">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h5 class="mb-0 text-dark" style="font-size: 1.1rem;"><i
                                    class="lni lni-package me-2 text-primary"></i> Order Items</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0" style="font-size: 0.9rem;">
                                    <thead class="bg-light text-muted">
                                        <tr>
                                            <th class="ps-4 py-3">Product</th>
                                            <th class="py-3 text-center">Price</th>
                                            <th class="py-3 text-center">Qty</th>
                                            <th class="text-end pe-4 py-3">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $item)
                                            <tr>
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="product-img-wrapper me-3">
                                                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                                                class="rounded shadow-sm"
                                                                style="width: 85px; height: 85px; object-fit: cover; border: 1px solid #eee;">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark"
                                                                style="font-size: 0.95rem;">{{ $item->name }}</h6>
                                                            <p class="text-muted mb-0 x-small"
                                                                style="font-size: 0.75rem;">Category:
                                                                {{ $item->category->name ?? 'General' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><span>{{ currency($item->price) }}</span></td>
                                                <td class="text-center"><span
                                                        class="badge bg-light text-dark border px-2 py-1">x{{ $item->order_item->quantity }}</span>
                                                </td>
                                                <td class="text-end pe-4 text-primary fw-bold">
                                                    {{ currency($item->price * $item->order_item->quantity) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        @if ($order->discount > 0)
                                            <tr>
                                                <td colspan="3" class="ps-4 py-2 text-muted fw-bold">Discount:</td>
                                                <td class="text-end pe-4 py-2 text-danger fw-bold">-
                                                    {{ currency($order->discount) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" class="ps-4 py-3 h6 fw-bold text-dark">Total:</td>
                                            <td class="text-end pe-4 py-3 text-success fw-bold h5">
                                                {{ currency($order->total) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="card border-0 shadow-lg mb-4">
                        <div class="card-body p-4">
                            <h6 class="mb-3 border-bottom pb-2 text-uppercase fw-bold"
                                style="font-size: 0.8rem; letter-spacing: 1px;">Status & Payment</h6>

                            <div class="mb-3">
                                <label class="x-small text-muted d-block mb-1" style="font-size: 0.7rem;">Order
                                    Status</label>
                                <span
                                    class="badge rounded-pill {{ $order->StatusBadgeClass() }} text-dark px-3 py-1 shadow-sm"
                                    style="font-size: 0.75rem;">
                                    <i class="lni lni-timer me-1"></i> {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="x-small text-muted d-block mb-1" style="font-size: 0.7rem;">Payment
                                    Status</label>
                                <span class="{{ $order->paymentColor() }} fw-bold small"><i
                                        class="lni lni-warning me-1"></i>
                                    {{ ucfirst($order->payment_status) }}</span>
                            </div>

                            <div class="mb-4">
                                <label class="x-small text-muted d-block mb-1" style="font-size: 0.7rem;">Payment
                                    Method</label>
                                <span class="text-dark fw-bold small"><i
                                        class="lni lni-credit-cards me-2 text-primary"></i>
                                    {{ strtoupper($order->payment_method) }}</span>
                            </div>

                            @if ($order->status == 'pending')
                                <div class="border-top pt-3">
                                    <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 shadow-sm">
                                            <i class="lni lni-close me-2"></i> Cancel Order
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4">
                            <h6 class="mb-3 border-bottom pb-2 text-uppercase fw-bold"
                                style="font-size: 0.8rem; letter-spacing: 1px;">Delivery Details</h6>

                            <div class="customer-info mb-3">
                                <p class="fw-bold mb-1 text-primary small">
                                    {{ $order->shippingAddress->name }}</p>
                                <p class="mb-1 text-dark x-small" style="font-size: 0.8rem;"><i
                                        class="lni lni-envelope me-2"></i>{{ $order->shippingAddress->email ?? 'N/A' }}
                                </p>
                                <p class="mb-0 text-dark x-small" style="font-size: 0.8rem;"><i
                                        class="lni lni-phone me-2"></i>{{ $order->shippingAddress->phone_number ?? 'N/A' }}
                                </p>
                            </div>

                            <hr class="my-3">

                            <div class="shipping-address">
                                <label class="x-small text-muted d-block mb-1" style="font-size: 0.7rem;">Shipping
                                    Address</label>
                                <p class="text-dark mb-0 small" style="line-height: 1.5;">
                                    <i class="lni lni-map-marker text-danger"></i>
                                    {{ $order->shippingAddress->street_address ?? 'N/A' }}<br>
                                    <span class="ps-3">{{ $order->shippingAddress->city ?? 'N/A' }},
                                        {{ $order->shippingAddress->governorate ?? 'N/A' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
