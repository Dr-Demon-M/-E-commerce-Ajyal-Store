@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-store-alt mr-2 text-primary"></i>Stores Trash</h4>
        <div class="btn-group">
            <a href="{{ route('stores.index') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                <i class="fas fa-plus mr-1"></i> Show All Stores
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Stores</li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <x-alert />
    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Store Name</label>
                    <x-form.input name='name' placeholder='Search by name...' class="form-control-sm"
                        :value="request('name')" />
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-dark btn-block shadow-sm">
                        <i class="fas fa-filter mr-1"></i> Filter
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
                            <th class="pl-4" style="width: 80px;">Logo</th>
                            <th>Store Details</th>
                            <th class="text-center">Status</th>
                            <th>Deleted Date</th>
                            <th class="text-right pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stores as $store)
                            <tr>
                                <td class="pl-4">
                                    @if ($store->logo_image)
                                        <img src="{{ asset('storage/' . $store->logo_image) }}"
                                            class="rounded-circle border shadow-sm"
                                            style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-soft-secondary text-secondary d-flex align-items-center justify-content-center border"
                                            style="width: 45px; height: 45px; font-weight: bold;">
                                            {{ substr($store->name, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $store->name }}</div>
                                    <small class="text-muted text-xs">ID: #{{ $store->id }}</small>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $store->status == 'active' ? 'bg-success' : 'bg-soft-danger text-danger' }} px-2 py-1 rounded-pill"
                                        style="font-size: 0.7rem;">
                                        {{ ucfirst($store->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small">{{ $store->deleted_at->format('M d, Y') }}</div>
                                    <small class="text-muted text-xs">{{ $store->deleted_at->diffForHumans() }}</small>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                                                                <form action="{{ route('stores.restore', $store->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-info border"
                                                title="Restore">
                                                <i class="fas fa-undo-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('stores.forceDelete', $store->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-danger border border-left-0"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-center text-muted italic">
                                    <i class="fas fa-store-slash fa-3x mb-3 d-block opacity-25"></i>
                                    No stores found in the Trash.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $stores->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
