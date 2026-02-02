<x-front-layout title="Profile">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Profile</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i>Home</a></li>
                            <li>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="checkout-steps-form-style-1">

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body p-4">
                                @include('Front.profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body p-4">
                                @include('Front.profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="card mb-4 border-0 shadow-sm border-top border-danger">
                            <div class="card-body p-4">
                                @include('Front.profile.partials.delete-user-form')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
