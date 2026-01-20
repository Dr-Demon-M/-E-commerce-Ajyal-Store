@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold">
            <i class="fas fa-trash-alt text-danger mr-2"></i> Archived Categories <small class="text-muted">(Trash)</small>
        </h4>
        <div class="btn-group shadow-sm">
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-white border">
                <i class="fas fa-list mr-1"></i> Active Categories
            </a>
            <button class="btn btn-sm btn-danger px-3 border-left-0">
                <i class="fas fa-sync mr-1"></i> Trash View
            </button>
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active text-danger">Trash</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-danger shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted text-uppercase">Search by Name</label>
                    <x-form.input name='name' placeholder='Find deleted category...'
                        class="form-control-sm shadow-none border-light" :value="request('name')" />
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Original Status</label>
                    <select name="status" class="form-control form-control-sm shadow-none border-light">
                        <option value="">All</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-dark btn-block shadow-sm">
                        <i class="fas fa-search mr-1"></i> Search Trash
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-light text-muted">
                        <tr class="text-sm">
                            <th class="pl-4">Preview</th>
                            <th>ID</th>
                            <th class="text-left">Category Details</th>
                            <th>Status</th>
                            <th>Deleted At</th>
                            <th class="pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories ?? [] as $category)
                            <tr>
                                <td class="pl-4">
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        class="rounded grayscale shadow-xs border"
                                        style="width: 45px; height: 45px; object-fit: cover; opacity: 0.7;">
                                </td>
                                <td class="text-muted small">#{{ $category->id }}</td>
                                <td class="text-left">
                                    <div class="fw-bold text-secondary text-decoration-line-through">{{ $category->name }}
                                    </div>
                                    <small class="text-muted">Parent: {{ $category->parent_name ?? 'None' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-soft-secondary text-secondary px-2 py-1">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-danger small fw-600">
                                        <i class="far fa-calendar-times mr-1"></i>
                                        {{ optional($category->deleted_at)->format('d M, Y') }}
                                    </div>
                                </td>
                                <td class="pr-4 text-right">
                                    <div class="btn-group shadow-sm">
                                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-sm btn-white text-success border"
                                                title="Restore">
                                                <i class="fas fa-undo"></i> Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('categories.forceDelete', $category->id) }}" method="post"
                                            onsubmit="return confirm('WARNING: This action cannot be undone!')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-danger border border-left-0"
                                                title="Delete Permanently">
                                                <i class="fas fa-fire"></i> Force Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-5 text-center text-muted">
                                    <i class="fas fa-trash-restore fa-3x mb-3 d-block opacity-25"></i>
                                    The trash is empty. Good job!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{-- {{ $categories->withQueryString()->links() }} --}}
            </div>
        </div>
    </div>
@endsection
