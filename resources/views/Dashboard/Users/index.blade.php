@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-users nav-icon text-primary"></i> Users Management</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-9">
                    <label class="form-label small fw-bold text-muted">Name or Email</label>
                    <x-form.input name='name' placeholder='Search by name...' class="form-control-sm"
                        :value="request('name')" />
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
                            <th>Phone Number</th>
                            <th>Last Active</th>
                            <th>Two Factor</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="text-muted small">#{{ $user->id }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $user->phone_number }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        {{ \Carbon\Carbon::parse($user->last_active)->format('Y-m-d H:i') }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $user->two_factor_secret ? 'Enable' : 'Disable' }}
                                    </div>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
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
                                    No Users found in the database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
