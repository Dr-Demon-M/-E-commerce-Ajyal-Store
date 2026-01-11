@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center">
        <i class="fas fa-edit text-primary mr-2"></i>
        <h4 class="mb-0 text-dark fw-bold">Profile</span></h4>
    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<form action="{{ route('dashboard.profile.edit') }}" method="post">
    @csrf
    @method('patch')

    <div class="container">
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" label="Gender" :options="[
                    'male' => 'Male',
                    'female' => 'Female',
                ]" :checked="optional($user->profile)->gender" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="street_address" label="Street Address" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input name="city" label="City" :value="$user->profile->last_name" />
            </div>
            <div class="col-md-6">
                <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.select name="country" label="Country" :selected="$user->profile->country" :options="$countries" />
            </div>
            <div class="col-md-6">
                <x-form.select name="locale" label="Locale" :selected="$user->profile->locale" :options="$locale" />
            </div>
        </div>
        <button type="submit">Save</button>
    </div>
    
</form>
@endsection
