@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-folder-open mr-2 text-primary"></i>Categories Management</h4>
        <div class="btn-group">
            @can('create', App\Models\Category::class)
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                <i class="fas fa-plus mr-1"></i> Create
            </a>    
            @endcan
            @can('delete', App\Models\Category::class)
            <a href="{{ route('categories.trash') }}" class="btn btn-sm btn-outline-danger shadow-sm px-3 border-left-0">
                <i class="fas fa-trash-alt mr-1"></i> Trash
            </a>
            @endcan
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <x-alert /> {{-- component --}}

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-muted text-uppercase">Search Name</label>
                    <x-form.input name='name' placeholder='Category name...' class="form-control-sm" :value="request('name')" />
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-dark btn-block shadow-sm">
                        <i class="fas fa-filter mr-1"></i> Apply Filter
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
                            <th class="pl-4">Image</th>
                            <th>ID</th>
                            <th>Name & Parent</th>
                            <th class="text-center">Products</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th class="text-right pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="pl-4">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="rounded shadow-xs border"
                                        style="width: 45px; height: 45px; object-fit: cover;"
                                        onerror="this.src='https://ui-avatars.com/api/?name={{ $category->name }}&background=f8f9fa&color=6c757d?format=svg'">
                                </td>
                                <td class="text-muted small">#{{ $category->id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $category->name }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-level-up-alt fa-rotate-90 mr-1 text-xs"></i>
                                        {{ $category->parent->name ?? 'Main Category' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category->id) }}"
                                        class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill shadow-none border">
                                        {{ $category->products_num }} Products
                                    </a>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-soft-warning text-warning' }} px-2 py-1">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small">{{ $category->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group">
                                        @can('update', App\Models\Category::class)
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-white text-primary border shadow-none" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete', App\Models\Category::class)
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                            onsubmit="return confirm('Move to trash?')"> {{-- js condition to confirm delete --}}
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-danger border border-left-0 shadow-none"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center text-muted">
                                    <i class="far fa-folder-open fa-3x mb-3 opacity-25 d-block"></i>
                                    No categories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
