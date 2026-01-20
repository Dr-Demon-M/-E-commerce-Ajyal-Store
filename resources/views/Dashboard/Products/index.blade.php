@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <div class="bg-soft-primary p-2 rounded mr-3">
                <i class="fas fa-boxes text-primary fa-lg"></i>
            </div>
            <h4 class="mb-0 text-dark fw-bold">Products List</h4>
        </div>

        <div class="btn-group">
            @can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-success shadow-sm px-3">
                <i class="fas fa-plus mr-1"></i> Add
            </a>
            @endcan
            @can('delete', App\Models\Product::class)
            <a href="{{ route('products.trash') }}" class="btn btn-sm btn-outline-danger shadow-sm px-3 border-left-0">
                <i class="fas fa-trash-alt mr-1"></i> Trash
            </a>
            @endcan
        </div>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <x-alert />

    <div class="card card-outline card-primary shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ URL::Current() }}" method="get" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold">Search Name</label>
                    <x-form.input name='name' placeholder='Product name...' class="form-control-sm" :value="request('name')" />
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                        <option value="draft" @selected(request('status') == 'draft')>Draft</option>
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
                            <th class="pl-4">Thumbnail</th>
                            <th>ID</th>
                            <th>Information</th>
                            <th>Status</th>
                            <th>Relations</th>
                            <th>Dates</th>
                            <th class="text-right pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="pl-4">
                                    <img src="{{ $product->image_Url }}" {{--  accessors attribute --}}
                                        class="rounded shadow-sm border" height="45" width="45"
                                        style="object-fit: cover;">
                                </td>
                                <td class="text-muted small">#{{ $product->id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <small class="text-muted">ID: {{ $product->id }}</small>
                                </td>
                                <td>
                                    @php
                                        $badgeColor =
                                            [
                                                'active' => 'bg-success',
                                                'archived' => 'bg-secondary',
                                                'draft' => 'bg-warning text-dark',
                                            ][$product->status] ?? 'bg-light';
                                    @endphp
                                    <span class="badge {{ $badgeColor }} px-2 py-1" style="font-size: 0.75rem;">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-xs mb-1">
                                        <i class="fas fa-store text-info mr-1"></i>
                                        <a href="#"
                                            class="text-decoration-none">
                                            {{ optional($product->store)->name ?? 'No Store' }}
                                        </a>
                                    </div>
                                    <div class="text-xs">
                                        <i class="fas fa-tag text-secondary mr-1"></i>
                                        <a href="{{ route('categories.index') }}" class="text-decoration-none text-muted">
                                            {{ $product->category->name ?? '' }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">Created:
                                        <strong>{{ $product->created_at->format('d M, Y') }}</strong>
                                    </div>
                                    @if ($product->deleted_at)
                                        <div class="small text-danger">Deleted:
                                            <strong>{{ $product->deleted_at->format('d M, Y') }}</strong>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right pr-4">
                                    <div class="btn-group shadow-sm">
                                        @can('view', App\Models\Product::class)
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-sm btn-white text-info border" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('update', App\Models\Product::class)
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-white text-primary border" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete', App\Models\Product::class)
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                            onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm btn-white text-danger border border-left-0"
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
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
