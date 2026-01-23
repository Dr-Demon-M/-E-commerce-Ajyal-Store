@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-Product text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Product Details</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="container-fluid mt-4">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="position-relative">
                <div class="bg-light" style="height: 300px; overflow: hidden;">
                        <img src="{{ $product->image_Url }}" class="w-100 h-100"
                            style="object-fit: cover;">
                </div>
            </div>

            <div class="card-body pt-5 mt-4">
                <div class="row pt-2">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-2">
                            <h2 class="fw-bold text-dark mr-3 mb-0">{{ $product->name }}</h2>
                            <span
                                @php
                                    $badgeColor =[
                                                'active' => 'bg-success',
                                                'archived' => 'bg-secondary',
                                                'draft' => 'bg-warning text-dark',
                                            ][$product->status] ?? 'bg-light'; @endphp
                                class="badge {{ $badgeColor }} px-3 rounded-pill">
                                {{ ucfirst($product->status) }}
                                </class=>
                        </div>
                        <p class="text-muted"><i class="fas fa-hashtag mr-1"></i> Product ID: #{{ $product->id }}</p>

                        <div class="mt-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3" style="letter-spacing: 1px;">Description</h6>
                            <p class="text-secondary leading-relaxed" style="font-size: 1.1rem;">
                                {{ $product->description ?: 'No description provided for this Product.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 border-left">
                        <div class="p-3 bg-light rounded shadow-none">
                            <h6 class="fw-bold text-dark mb-3">Product Information</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Created Date</span>
                                <span class="fw-600 small">{{ $product->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Last Update</span>
                                <span class="fw-600 small">{{ $product->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white py-3 border-top-0 d-flex gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm px-4">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
                <a href="{{ route('products.edit', $product->id) }}"
                    class="btn btn-warning btn-sm px-4 shadow-sm text-dark">
                    <i class="fas fa-edit mr-1"></i> Edit Product
                </a>
            </div>
        </div>
    </div>
@endsection
