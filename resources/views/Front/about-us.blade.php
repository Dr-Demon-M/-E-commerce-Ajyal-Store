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

    <!-- Start Team Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Our Core Team</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Grace Wright</h3>
                                <h5>Founder, CEO</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Taylor Jackson</h3>
                                <h5>Financial Director</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Quinton Cross</h3>
                                <h5>Marketing Director</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Liana Mullen</h3>
                                <h5>Lead Designer</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Area -->

</x-front-layout>
