<x-front-layout title="Cart">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>About Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>


    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-between justify-content-between">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="content-left">
                        <img src="{{ asset('assets/images/favicon.svg') }}" alt="#">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right">
                        <h2>Ajyal Store – Shopping Made Simple, Smart & Reliable</h2>
                        <p>wide variety of quality products at competitive prices — without the hassle.

                            We’re a multi-vendor online marketplace built for people who value smart shopping. Whether
                            you’re buying or selling, our platform is designed to make the entire process smooth,
                            secure, and straightforward.

                            What makes us different is our focus on balance — premium quality without inflated prices,
                            easy purchasing without complicated steps, and a clear return and pickup process that
                            respects your time.
                        </p>
                        <p>We believe that a great shopping experience doesn’t stop at checkout. That’s why we
                            prioritize customer satisfaction, reliable support, and clear communication at every step.

                            Ajyal Store is new, but our commitment is strong:
                            better value, easier selling, and a marketplace you can trust.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

</x-front-layout>
