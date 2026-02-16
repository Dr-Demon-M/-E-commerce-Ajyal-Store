    @extends('layouts.dashboardLayout')

    @section('title')
        <div class="d-flex align-items-center">
            <div class="bg-soft-primary p-2 rounded mr-3">
                <i class="fas fa-user-circle text-primary fa-lg"></i>
            </div>
            <h4 class="mb-0 text-dark fw-bold">Edit Profile</h4>
        </div>
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Profile</li>
    @endsection

    @section('content')
        <div class="container-fluid mt-4">
            <form action="{{ route('dashboard.profile.edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <x-alert />
                        <x-dashboard.error />

                        <div class="card shadow-sm border-0 mb-4 rounded-lg">
                            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                                <h5 class="text-dark fw-bold mb-0"><i class="fas fa-info-circle mr-2 text-primary"></i>
                                    Personal
                                    Information</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile->birthday"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-form.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="optional($user->profile)->gender" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <x-form.input name="image" type="file" label="Profile Image"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-4 rounded-lg">
                            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                                <h5 class="text-dark fw-bold mb-0"><i class="fas fa-map-marker-alt mr-2 text-danger"></i>
                                    Address Details</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-form.input name="street_address" label="Street Address" :value="$user->profile->street_address"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-4 rounded-lg">
                            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                                <h5 class="text-dark fw-bold mb-0"><i class="fas fa-globe mr-2 text-success"></i> Regional
                                    Settings</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-form.select name="governorate" label="Governorate" :selected="$user->profile->governorate" :options="$governorates"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-form.select name="city" label="City" :selected="$user->profile->city" :options="$cities"
                                            class="bg-light border-0 shadow-none" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
                                <i class="fas fa-save mr-2"></i> Save Profile Changes
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        </div>
    @endsection
