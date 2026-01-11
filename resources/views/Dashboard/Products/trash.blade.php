@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-danger fw-bold"><i class="fas fa-trash-restore mr-2"></i>Archived Products (Trash)</h4>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary shadow-sm">
                <i class="fas fa-list mr-1"></i> Back to All Products
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-danger shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-muted">Search in Trash</label>
                    <x-form.input name='name' placeholder='Product name...' class="form-control-sm" :value="request('name')" />
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                        <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-danger btn-block shadow-sm">
                        <i class="fas fa-search mr-1"></i> Search Trash
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-sm text-muted">
                            <th class="pl-4">Image</th>
                            <th>ID</th>
                            <th>Product Info</th>
                            <th>Status</th>
                            <th>Store/Category</th>
                            <th>Deleted At</th>
                            <th class="text-right pr-4">Restoration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="bg-white">
                                <td class="pl-4">
                                    <img src="{{ $product->product_image }}" 
                                         class="rounded grayscale shadow-sm border" 
                                         height="45" width="45" 
                                         style="object-fit: cover; filter: grayscale(80%);">
                                </td>
                                <td class="text-muted small">#{{ $product->id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <small class="text-danger font-italic">Temporarily Deleted</small>
                                </td>
                                <td>
                                    <span class="badge bg-light border text-muted px-2 py-1">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small mb-1"><i class="fas fa-store mr-1"></i> {{ optional($product->store)->name }}</div>
                                    <div class="small text-muted"><i class="fas fa-folder mr-1"></i> {{ $product->category->name }}</div>
                                </td>
                                <td>
                                    <div class="text-sm text-danger fw-bold">
                                        {{ optional($product->deleted_at)->format('d M, Y') }}
                                    </div>
                                    <small class="text-muted">{{ optional($product->deleted_at)->diffForHumans() }}</small>
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                        <form action="{{ route('products.restore', $product->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-sm btn-white text-success border" title="Restore Product">
                                                <i class="fas fa-undo-alt"></i> Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('products.forceDelete', $product->id) }}" method="post" class="d-inline" onsubmit="return confirm('WARNING: Permanent deletion cannot be undone!')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-white text-danger border border-left-0" title="Delete Permanently">
                                                <i class="fas fa-fire-alt"></i> Force
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center text-muted">
                                    <i class="fas fa-trash fa-3x mb-3 d-block opacity-25"></i>
                                    Trash is empty! No deleted products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-center mt-2">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection