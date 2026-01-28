@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold">
            <i class="fas fa-boxes text--primary mr-2"></i> {{ $category->name }} Products
        </h4>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                <i class="fas fa-plus mr-1"></i> Add Product
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body py-3">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-muted">Product Name</label>
                    <x-form.input name='name' placeholder='Search products...' class="form-control-sm" :value="request('name')" />
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
                    <button type="submit" class="btn btn-sm btn-dark btn-block shadow-sm">
                        <i class="fas fa-search mr-1"></i> Filter Products
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
                            <th class="pl-4">Image</th>
                            <th>ID</th>
                            <th class="text-left">Product Name</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Featured</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="pl-4">
                                    <img src="{{ $product->image_url}}" 
                                         class="rounded shadow-xs border" 
                                         style="width: 45px; height: 45px; object-fit: cover;">
                                </td>
                                <td class="text-muted small">#{{ $product->id }}</td>
                                <td class="text-left">
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <small class="text-muted">Store ID: #{{  $product->store_id }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $product->status == 'active' ? 'bg-soft-success text-success' : 'bg-soft-secondary text-secondary' }} px-2 py-1">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td>
                                    <div class="text-warning small">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="{{ $i <= $product->rate ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                        <span class="text-muted ml-1">({{ $product->rate }})</span>
                                    </div>
                                </td>
                                <td>
                                    @if($product->featured)
                                        <span class="badge bg-warning text-white rounded-pill px-3">
                                            <i class="fas fa-crown mr-1"></i> {{ $product->featured }}%
                                        </span>
                                    @else
                                        <span class="text-muted small">Normal</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">{{ $product->created_at->format('d M, Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-5 text-center text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 d-block opacity-25"></i>
                                    No products found in this category.
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