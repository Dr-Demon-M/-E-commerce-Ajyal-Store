@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-clipboard-list nav-icon text-primary"></i> Orders List</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold">Search Name</label>
                    <x-form.input name='name' placeholder=' name...' class="form-control-sm" :value="request('name')" />
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                        <option value="processing" @selected(request('status') == 'processing')>Processing</option>
                        <option value="delivering" @selected(request('status') == 'delivering')>Delivering</option>
                        <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                        <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
                        <option value="refunded" @selected(request('status') == 'refunded')>Refunded</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-dark btn-block shadow-sm">
                        <i class="fas fa-filter mr-1"></i> Filter Results
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr class="text-sm">
                            <th class="pl-4">User name</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Total Price</th>
                            <th>Created at</th>
                            <th class="text-right pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="text-muted">
                                    {{ $order->shippingAddress->name }}
                                </td>
                                <td>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                        class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status"
                                            class="form-control form-control-sm select-no-arrow {{ $order->StatusBadgeClass() }}"
                                            onchange="this.form.submit()">

                                            <option value="pending" @selected($order->status == 'pending')>Pending</option>
                                            <option value="processing" @selected($order->status == 'processing')>Processing</option>
                                            <option value="delivering" @selected($order->status == 'delivering')>Delivering</option>
                                            <option value="completed" @selected($order->status == 'completed')>Completed</option>
                                            <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                                            <option value="refunded" @selected($order->status == 'refunded')>Refunded</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $order->payment_method }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $order->paymentColor() }} px-3 py-2 text-uppercase"
                                        style="font-size: 0.75rem;">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        {{ currency($order->total, 'USD') ?? currency($order->total, 'USD') }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark small">Created:
                                        <strong>{{ $order->created_at->format('d M, Y') }}</strong>
                                    </div>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                        {{-- @can('view', App\Models\Product::class) --}}
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="btn btn-sm btn-white text-info border" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- @endcan --}}
                                        {{-- @can('delete', App\Models\Product::class) --}}
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post"
                                            onsubmit="return confirm('Delete this order?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-danger border border-left-0"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- @endcan --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center text-muted italic">
                                    <i class="fas fa-box-open fa-3x mb-3 d-block opacity-50"></i>
                                    No products found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
