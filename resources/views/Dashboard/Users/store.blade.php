@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <div class="bg-soft-primary p-2 rounded mr-3">
            <i class="fas fa-store text-primary fa-lg"></i>
        </div>
        <h4 class="mb-0 text-dark fw-bold">Add New Admin</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admins</a></li>
    <li class="breadcrumb-item active">Add Admin</li>
@endsection

@section('content')
    <x-dashboard.error />

    <div class="card shadow-sm border-0 rounded-lg">
        <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('Dashboard.Admins._form', [
                'button' => 'Create Admin',
            ])
        </form>
    </div>
@endsection
