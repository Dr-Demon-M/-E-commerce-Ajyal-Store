@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <div class="bg-soft-primary p-2 rounded mr-3">
            <i class="fas fa-store text-primary fa-lg"></i>
        </div>
        <h4 class="mb-0 text-dark fw-bold">Add New Store</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Stores</a></li>
    <li class="breadcrumb-item active">Add Store</li>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($errors->any())
                    <div class="alert alert-light border-left border-danger shadow-sm mb-4" role="alert"
                        style="border-left: 5px solid #dc3545 !important; opacity: 1 !important;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-danger mr-3 fa-2x"></i>
                            <div>
                                <h6 class="text-danger fw-bold mb-1">Whoops! Something went wrong.</h6>
                                <ul class="list-unstyled mb-0 small text-secondary">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-dot-circle text-danger mr-1" style="font-size: 8px;"></i>
                                            {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card shadow-sm border-0 rounded-lg">
                    <form action="{{ route('stores.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Store Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0"><i
                                                    class="fas fa-shopping-basket text-muted"></i></span>
                                        </div>
                                        <input type="text" name="name"
                                            class="form-control form-control-lg border-left-0 bg-light shadow-none"
                                            placeholder="Enter a unique store name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                    <textarea name="description" class="form-control border-0 bg-light p-3 shadow-none" rows="4"
                                        placeholder="Describe the store's niche..." style="resize: none; border-radius: 10px;">{{ old('description') }}</textarea>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Cover Image</label>
                                    <input type="file" name="cover_image"
                                        class="form-control border-0 bg-light shadow-none" id="coverImage">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Logo Image</label>
                                    <input type="file" name="logo_image"
                                        class="form-control border-0 bg-light shadow-none" id="logoImage">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Store Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0"><i
                                                    class="fas fa-toggle-on text-muted"></i></span>
                                        </div>
                                        <select name="status"
                                            class="form-control form-control-lg border-left-0 bg-light shadow-none">
                                            <option value="" selected disabled>Choose status...</option>
                                            <option value="active" @selected(old('status') == 'active')>Active</option>
                                            <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 p-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
                                <i class="fas fa-check-circle mr-2"></i> Create Store
                            </button>
                            <a href="{{ route('stores.index') }}" class="btn btn-link text-muted fw-bold ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
