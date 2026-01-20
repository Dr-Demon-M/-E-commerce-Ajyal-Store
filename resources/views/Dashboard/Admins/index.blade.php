@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-store-alt mr-2 text-primary"></i>Admins Management</h4>
        <div class="btn-group">
            <a href="{{ route('admins.create') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                <i class="fas fa-plus mr-1"></i> Add
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Admin Name</label>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone Number</th>
                            <th>Store </th>
                            <th class="text-center">Status</th>
                            <th class="text-right pr-4">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            <tr>
                                <td>
                                    <div class="text-muted small">#{{ $admin->id }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $admin->name }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $admin->email }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $admin->username }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $admin->phone_number }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $admin->store->name ?? '' }}</div>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $admin->status == 'active' ? 'bg-success' : 'bg-soft-danger text-danger' }} px-2 py-1 rounded-pill"
                                        style="font-size: 0.7rem;">
                                        {{ ucfirst($admin->status) }}
                                    </span>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                        <a href="{{ route('admins.edit', $admin->id) }}"
                                            class="btn btn-sm btn-white text-primary border border-left-0" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admins.destroy', $admin->id) }}" method="post"
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
                                    No Admins found in the database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $admins->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
