@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-user-shield nav-icon text-primary"></i> Roles Management</h4>
        <div class="btn-group">
            @can('create', App\Models\Role::class)
                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                    <i class="fas fa-plus mr-1"></i> Create
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
    <x-alert /> {{-- component --}}


    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr class="text-sm">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td class="text-muted small">#{{ $role->id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $role->name }}</div>
                                </td>
                                <td>
                                    <div class="small">{{ $role->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group">
                                        @can('update', App\Models\Role::class)
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                class="btn btn-sm btn-white text-primary border shadow-none" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @if (Auth::user()->can('roles.destroy'))
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                                                onsubmit="return confirm('Move to trash?')"> {{-- js condition to confirm delete --}}
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-sm btn-white text-danger border border-left-0 shadow-none"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center text-muted">
                                    <i class="far fa-folder-open fa-3x mb-3 opacity-25 d-block"></i>
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $roles->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
