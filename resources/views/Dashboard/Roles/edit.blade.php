@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-edit text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Edit Role: <span class="text-primary">{{ $role->name }}</span></h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit Role</li>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <p class="text-muted mb-0 small text-uppercase fw-bold">
                            <i class="fas fa-history mr-1 text-info"></i> Update existing role information
                        </p>
                    </div>

                    <form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- استدعاء الـ _form المنسق مع تغيير نص الزر --}}
                        @include('Dashboard.Roles._form', [
                            'button_label' => 'Update Role',
                            'role_ability' => $role_ability
                        ])
                    </form>
                </div>
                
                <div class="text-center mt-3">
                    <p class="text-muted small">
                        <i class="far fa-clock mr-1"></i> 
                        Last updated: {{ $role->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection