@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-chart-line text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Store Statistics Overview</h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>   
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>150</h3> <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <a href="{{ route('admins.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success shadow-sm">
                        <div class="inner">
                            <h3>$5,230</h3> <p>Total Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning shadow-sm">
                        <div class="inner">
                            <h3>44</h3> <p>Active Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <a href="{{ route('admins.index') }}" class="small-box-footer">Manage Store <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger shadow-sm">
                        <div class="inner">
                            <h3>65</h3> <p>New Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Users <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header border-0">
                            <h3 class="card-title fw-bold">Latest Orders</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm"> <i class="fas fa-download"></i> </a>
                                <a href="#" class="btn btn-tool btn-sm"> <i class="fas fa-bars"></i> </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#1234</td>
                                        <td>Ahmed Mohamed</td>
                                        <td>$150 USD</td>
                                        <td><span class="badge badge-success">Completed</span></td>
                                        <td><a href="#" class="text-muted"><i class="fas fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>#1235</td>
                                        <td>Sara Ali</td>
                                        <td>$89 USD</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td><a href="#" class="text-muted"><i class="fas fa-search"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white">
                            <h3 class="card-title fw-bold text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Low Stock Alert</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    IPhone 15 Pro Max
                                    <span class="badge badge-danger badge-pill">2 left</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    AirPods Pro 2
                                    <span class="badge badge-danger badge-pill">1 left</span>
                                </li>
                            </ul>
                            <div class="mt-4 text-center">
                                <a href="#" class="btn btn-outline-primary btn-sm btn-block">Restock All Items</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection