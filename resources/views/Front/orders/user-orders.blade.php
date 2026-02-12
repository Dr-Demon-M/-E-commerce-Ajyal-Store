<x-front-layout title="My Orders">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">My Orders</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Order History</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>


    <section class="checkout-wrapper section">
        <div class="container">
            <div>
                <x-alert />
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="checkout-steps-form-style-1">
                        @if ($orders->count() > 0)
                            <div class="card border-0 shadow-lg">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="mb-0 text-dark">Recent Orders</h4>
                                        <span class="text-muted small">Track and manage your purchases</span>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle" style="font-size: 0.95rem;">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="py-3 ps-4" style="font-weight: 600;">Order #</th>
                                                    <th class="py-3" style="font-weight: 600;">Date</th>
                                                    <th class="py-3 text-center" style="font-weight: 600;">Payment</th>
                                                    <th class="py-3 text-center" style="font-weight: 600;">Status</th>
                                                    <th class="py-3" style="font-weight: 600;">Total</th>
                                                    <th class="py-3 text-center pe-4" style="font-weight: 600;">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr class="border-bottom">
                                                        <td class="ps-4 py-3">
                                                            <span
                                                                class="text-primary fw-bold">#{{ $order->number }}</span>
                                                        </td>
                                                        <td class="text-secondary small">
                                                            {{ $order->created_at->format('d M, Y') }}</td>
                                                        <td class="text-center">
                                                            <span class="badge rounded-pill bg-info text-white px-3"
                                                                style="font-size: 0.75rem;">
                                                                {{ strtoupper($order->payment_method) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span
                                                                class="badge rounded-pill {{ $order->StatusBadgeClass() }} text-dark px-3 py-2"
                                                                style="font-size: 0.75rem;">
                                                                <i class="lni lni-timer me-1"></i>
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="fw-bold text-dark">EGP
                                                            {{ number_format($order->total, 2) }}</td>
                                                        <td class="text-center pe-4">
                                                            <a href="{{ route('user.orders.show', $order->id) }}"
                                                                class="btn btn-primary btn-sm shadow-sm rounded-pill px-4"
                                                                style="font-size: 0.85rem;">
                                                                View Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card border-0 shadow-lg mt-4">
                                <div class="card-body p-5 text-center">
                                    <div class="empty-icon mb-4">
                                        <i class="lni lni-cart-full text-muted"
                                            style="font-size: 60px; opacity: 0.3;"></i>
                                    </div>
                                    <h4 class="mb-2 text-dark">Your Order History is Empty</h4>
                                    <p class="text-muted mb-4">Looks like you haven't placed any orders yet. Start
                                        shopping to see your orders here!</p>
                                    <a href="{{ route('home') }}" class="btn btn-primary shadow-sm rounded-pill px-5">
                                        <i class="lni lni-shopping-basket me-2"></i> Start Shopping
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="card-footer bg-white border-top-0 py-3">
                            <div class="d-flex justify-content-center mt-2">
                                {{ $orders->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
