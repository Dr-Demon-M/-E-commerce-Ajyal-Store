@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-edit text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Edit Store</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Stores</a></li>
    <li class="breadcrumb-item active">Edit: {{ $store->name }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="container-fluid mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-outline card-primary shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-info-circle mr-1 text-muted"></i> Store Information
                        </h5>
                    </div>

                    <form action="{{ route('stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Store Name</label>
                                    <input type="text" name="name" 
                                           class="form-control form-control-lg border-light shadow-none @error('name') is-invalid @enderror"
                                           value="{{ old('name', $store->name) }}" 
                                           style="background-color: #f8f9fa;" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Status</label>
                                    <select name="status" class="form-control form-control-lg border-light shadow-none select2" style="background-color: #f8f9fa;">
                                        <option value="active" {{ $store->status == 'active' ? 'selected' : '' }}>🟢 Active</option>
                                        <option value="inactive" {{ $store->status == 'inactive' ? 'selected' : '' }}>🔴 Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                    <textarea name="description" 
                                              class="form-control border-light shadow-none" 
                                              rows="4" 
                                              style="background-color: #f8f9fa;">{{ old('description', $store->description) }}</textarea>
                                </div>

                                <div class="col-12"><hr class="opacity-50 my-4"></div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Store Logo</label>
                                    <div class="d-flex align-items-center p-3 border rounded bg-white shadow-xs">
                                        <div class="mr-3">
                                            @if($store->logo_image)
                                                <img src="{{ asset('storage/' . $store->logo_image) }}" 
                                                     class="rounded-circle border" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="logo_image" class="form-control-file text-xs">
                                            <small class="text-muted d-block mt-1">Leave empty to keep current</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Cover Image</label>
                                    <div class="d-flex align-items-center p-3 border rounded bg-white shadow-xs">
                                        <div class="mr-3 text-center">
                                            @if($store->cover_image)
                                                <img src="{{ asset('storage/' . $store->cover_image) }}" 
                                                     class="rounded border" 
                                                     style="width: 100px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="rounded bg-light d-flex align-items-center justify-content-center border" style="width: 100px; height: 60px;">
                                                    <i class="fas fa-images text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="cover_image" class="form-control-file text-xs">
                                            <small class="text-muted d-block mt-1">Leave empty to keep current</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light border-0 py-3 d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <i class="far fa-clock mr-1"></i> ID: #{{ $store->id }} | Updated: {{ $store->updated_at->diffForHumans() }}
                            </div>
                            <div>
                                <a href="{{ route('stores.index') }}" class="btn btn-white border px-4 mr-2 shadow-sm">Cancel</a>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="fas fa-save mr-1"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection