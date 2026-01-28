@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <div class="bg-soft-primary p-2 rounded mr-3">
                <i class="fas fa-tags text-primary "></i>
            </div>
            <h4 class="mb-0 text-dark ">Manage Coupons</h4>
        </div>
        <a href="{{ route('coupons.create') }}" class="btn btn-sm btn-primary shadow-sm px-3">
            <i class="fas fa-plus mr-1"></i> New Coupon
        </a>
    </div>
@endsection

@section('content')
    <x-alert />
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="pl-4" style="width: 80px;">ID</th>
                            <th>Coupon Name</th>
                            <th class="text-center">Discount Value</th>
                            <th class="text-right pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $coupon)
                            <tr>
                                <td class="pl-4 text-muted">#{{ $coupon['id'] }}</td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $coupon['name'] }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-soft-success text-success px-3 py-2" style="font-size: 0.9rem;">
                                        {{ $coupon['value'] }}
                                    </span>
                                </td>
                                <td class="text-right pr-4">
                                    <form method="POST" action="{{ route('coupons.destroy', $coupon->id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-sm btn-light border text-danger"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-ticket-alt fa-2x mb-2 d-block opacity-25"></i>
                                    No coupons available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .bg-soft-info {
            background-color: rgba(23, 162, 184, 0.1);
        }

        .bg-soft-success {
            background-color: rgba(40, 167, 69, 0.1);
        }

        .fw-bold {
            font-weight: 700;
        }
    </style>
@endsection
