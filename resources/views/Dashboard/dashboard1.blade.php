@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-rocket text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Starter Dashboard</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>   
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark mb-3">Quick Overview</h5>
                            <p class="card-text text-muted">
                                Welcome to your new dashboard. This card is designed to give you a clean area to start building your custom widgets or information blocks.
                            </p>
                            <div class="mt-3">
                                <a href="#" class="btn btn-sm btn-link text-primary pl-0 fw-600">Explore Docs</a>
                                <a href="#" class="btn btn-sm btn-link text-secondary fw-600">Settings</a>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary card-outline shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary mb-3">Getting Started</h5>
                            <p class="card-text text-secondary">
                                You can use the <code>card-outline</code> class to add a subtle colored top border that matches your primary theme color.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm px-4 shadow-sm">
                                <i class="fas fa-play-circle mr-1"></i> Start Tutorial
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="m-0 fw-bold text-dark"><i class="far fa-star text-warning mr-1"></i> Featured Content</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title fw-600 mb-2">Special System Treatment</h6>
                            <p class="card-text text-muted">With supporting text below as a natural lead-in to additional content, making your UI more descriptive.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm px-3">View Analytics</a>
                        </div>
                    </div>

                    <div class="card card-success card-outline shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="m-0 fw-bold text-success">Active Status</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title fw-600 mb-2">System Performance</h6>
                            <p class="card-text text-muted">Everything is running smoothly. Your server resources are well within the safe limits.</p>
                            <a href="#" class="btn btn-success btn-sm px-4 shadow-sm">
                                <i class="fas fa-check-circle mr-1"></i> Check Status
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div></div>
    @endsection