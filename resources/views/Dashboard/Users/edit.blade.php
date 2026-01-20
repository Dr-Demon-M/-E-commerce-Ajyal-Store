@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-edit text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Edit Admin</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admins</a></li>
    <li class="breadcrumb-item active">Edit : {{ $admin->name }}</li>
@endsection

@section('content')
    <x-alert />

    <div class="container-fluid mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-outline card-primary shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-info-circle mr-1 text-muted"></i> Admin Information
                        </h5>
                    </div>

                    <x-dashboard.error />

                    <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('Dashboard.Admins._form');
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
