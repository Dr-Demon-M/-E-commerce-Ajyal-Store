@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-plus-circle text-success mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Create New Category</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Create Category</li>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <p class="text-muted mb-0 small uppercase fw-bold">
                            <i class="fas fa-edit mr-1"></i> Fill in the category details below
                        </p>
                    </div>

                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        @include('Dashboard.Categories._form', [
                            'button_label' => 'Create Category'
                        ])
                    </form>
                </div>
                
                <div class="text-center mt-3">
                    <p class="text-muted small">
                        <i class="fas fa-info-circle mr-1"></i> 
                        Categories help you organize products for better customer navigation.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection