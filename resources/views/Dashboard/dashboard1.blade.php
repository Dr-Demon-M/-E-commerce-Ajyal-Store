@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-chart-line text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Store Statistics Overview</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>{{ $total_orders }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success shadow-sm">
                        <div class="inner">
                            <h3>{{ currency($total_incomes) }}</h3>
                            <p>Total Incomes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="{{ route('orders.index') }}" class="small-box-footer">View Orders <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning shadow-sm">
                        <div class="inner">
                            <h3>{{ $active_products }}</h3>
                            <p>Active Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <a href="{{ route('products.index') . '??status=active' }}" class="small-box-footer">Manage Products
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header border-0">
                            <h3 class="card-title fw-bold">Latest Orders</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastOrders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->shippingAddress->first_name . ' ' . $order->shippingAddress->last_name }}
                                            </td>
                                            <td>{{ currency($order->total) }}</td>
                                            <td><span
                                                    class="badge {{ $order->StatusBadgeClass() }}">{{ $order->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white">
                            <h3 class="card-title fw-bold text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Low
                                Stock Alert</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @forelse ($stock_product as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $product->name }}
                                        <span class="badge badge-danger badge-pill">{{ $product->quantity }} left</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center py-4">
                                        <i class="fas fa-check-circle text-success fa-3x mb-3 d-block"></i>
                                        <h6 class="text-dark fw-bold mb-1">All Good!</h6>
                                        <p class="text-muted small mb-0">No products are currently low in stock.</p>
                                    </li>
                                @endforelse
                            </ul>
                            @if ($stock_product->count() > 0)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('products.index') }}"
                                        class="btn btn-outline-primary btn-sm btn-block">Show All Products</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
