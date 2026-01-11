@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-store text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Store Details</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Stores</a></li>
    <li class="breadcrumb-item active">{{ $store->name }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="container-fluid mt-4">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="position-relative">
                <div class="bg-light" style="height: 200px; overflow: hidden;">
                    @if($store->cover_image)
                        <img src="{{ asset('storage/' . $store->cover_image) }}" class="w-100 h-100" style="object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                            <i class="far fa-image fa-3x"></i>
                        </div>
                    @endif
                </div>

                <div class="position-absolute" style="bottom: -50px; left: 30px; z-index: 5;">
                    <div class="rounded-circle border border-4 border-white shadow-sm bg-white" style="width: 120px; height: 120px; overflow: hidden;">
                        @if($store->logo_image)
                            <img src="{{ asset('storage/' . $store->logo_image) }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-soft-primary text-primary">
                                <span class="h2 mb-0">{{ substr($store->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body pt-5 mt-4">
                <div class="row pt-2">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-2">
                            <h2 class="fw-bold text-dark mr-3 mb-0">{{ $store->name }}</h2>
                            <span class="badge {{ $store->status == 'active' ? 'bg-success' : 'bg-danger' }} px-3 rounded-pill">
                                {{ ucfirst($store->status) }}
                            </span>
                        </div>
                        <p class="text-muted"><i class="fas fa-hashtag mr-1"></i> Store ID: #{{ $store->id }}</p>
                        
                        <div class="mt-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3" style="letter-spacing: 1px;">Description</h6>
                            <p class="text-secondary leading-relaxed" style="font-size: 1.1rem;">
                                {{ $store->description ?: 'No description provided for this store.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 border-left">
                        <div class="p-3 bg-light rounded shadow-none">
                            <h6 class="fw-bold text-dark mb-3">Store Information</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Created Date</span>
                                <span class="fw-600 small">{{ $store->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Last Update</span>
                                <span class="fw-600 small">{{ $store->updated_at->diffForHumans() }}</span>
                            </div>
                            <hr>
                            <div class="text-center mt-3">
                                <p class="small text-muted mb-0">Total Products</p>
                                <h3 class="fw-bold text-primary">{{ $store->product_num }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white py-3 border-top-0 d-flex gap-2">
                <a href="{{ route('stores.index') }}" class="btn btn-outline-secondary btn-sm px-4">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
                <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-warning btn-sm px-4 shadow-sm text-dark">
                    <i class="fas fa-edit mr-1"></i> Edit Store
                </a>
            </div>
        </div>
    </div>
@endsection