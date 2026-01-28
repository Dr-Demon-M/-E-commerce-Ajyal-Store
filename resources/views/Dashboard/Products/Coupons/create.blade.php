@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-tag text-success mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Add New Coupon</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Coupons</a></li>
    <li class="breadcrumb-item active">Add Coupon</li>
@endsection

@section('content')
    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf
        <div class="card-body p-4">
            <div class="card-footer bg-white border-top-0 p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Coupon Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i
                                        class="fas fa-font text-muted"></i></span>
                            </div>
                            <x-form.input type="text" name="name"
                                class="form-control form-control-lg border-left-0 shadow-none bg-light"
                                placeholder="Enter Coupon name..." />
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Coupon Value</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i
                                        class="fas fa-dollar-sign text-muted"></i></span>
                            </div>
                            <x-form.input type="text" name="value"
                                class="form-control form-control-lg border-left-0 shadow-none bg-light"
                                placeholder="Enter Value ..." />
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
                    <i class="fas fa-save mr-2"></i>Save Coupon
                </button>
                <a href="{{ route('coupons.index') }}" class="btn btn-link text-muted fw-bold">Cancel</a>
            </div>
        </div>
    </form>
@endsection
