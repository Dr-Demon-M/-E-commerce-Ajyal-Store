@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-plus-circle text-success mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Import Products</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Import Products</li>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <p class="text-muted mb-0 small uppercase fw-bold">
                            <i class="fas fa-edit mr-1"></i> Fill in the Product details below
                        </p>
                    </div>
                    <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="count" class="form-label">Number of Products to Import</label>
                                <input type="number" name="count" id="count" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-import mr-1"></i> Import Products
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
