<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('styles')

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <ul class="menu-top-link">
                                <li>
                                    <form action="{{ route('converter.store') }}" method="post">
                                        @csrf
                                        <div class="select-position">
                                            <select name="currency_code" onchange="this.form.submit()">
                                                <option value="USD" @selected('USD' == session('currency_code'))>$ USD</option>
                                                <option value="EUR" @selected('EUR' == session('currency_code'))>€ EURO</option>
                                                <option value="GBP" @selected('GBP' == session('currency_code'))>£ GBP</option>
                                                <option value="JPY" @selected('JPY' == session('currency_code'))>¥ JPY</option>
                                                <option value="EGP" @selected('EGP' == session('currency_code'))>E£ EGP</option>
                                            </select>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <form>
                                        <div class="select-position">
                                            <select onchange="window.location.href=this.value">
                                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <option
                                                        value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                                        @selected(app()->getLocale() === $localeCode)>
                                                        {{ $properties['native'] ?? $properties['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </form>
                        </div>
                        </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                            <li><a href="about-us.html">{{ __('About us') }}</a></li>
                            <li><a href="contact.html">{{ __('Contact us') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    @auth('web')
                        <div class="top-end">
                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ Auth::guard('web')->user()->name }}
                            </div>
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout').submit()">
                                        Sign out</a>
                                </li>
                                <li style="border:none !important;">
                                    <a href="{{ route('2fa') }}">2FA</a>
                                </li>
                                <form action="{{ route('logout') }}" id="logout" method="post" style="display:none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @else
                        <div class="top-end">
                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ __('Hello') }}
                            </div>
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        </div>
        <!-- End Topbar -->

        <!-- Start Header Middle -->
        <x-middle-header />
        <!-- End Header Middle -->

        <!-- Start Header Bottom -->
        <x-bottom-header />
        <!-- End Header Bottom -->
    </header>
    <!-- End Header Area -->

    <!-- Start Breadcrumbs -->
    {{ $breadcrumb ?? '' }}
    <!-- End Breadcrumbs -->

    {{ $slot }}

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/logo/white-logo.png') }}" alt="#">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    Subscribe to our Newsletter
                                    <span>Get all the latest information, Sales and Offers.</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="#" method="get" target="_blank" class="newsletter-form">
                                        <input name="EMAIL" placeholder="Email address here..." type="email">
                                        <div class="button">
                                            <button class="btn">Subscribe<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>Get In Touch With Us</h3>
                                <p class="phone">Phone: +20 123456789</p>
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@ajyalstore.com">support@ajyalstore.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer our-app">
                                <h3>Our Mobile App</h3>
                                <ul class="app-btn">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-apple"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">App Store</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-play-store"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">Google Play</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Information</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Shop Departments</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Sportswear</a></li>
                                    <li><a href="javascript:void(0)">Sneakers</a></li>
                                    <li><a href="javascript:void(0)">Running Shoes</a></li>
                                    <li><a href="javascript:void(0)">Training Shoes</a></li>
                                    <li><a href="javascript:void(0)">Sandals & Slides</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center justify-content-around">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>We Accept:</span>
                                <img src="{{ asset('assets/images/footer/credit-cards-footer.png') }}"
                                    alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="social">
                                <li>
                                    <span>Follow Us On:</span>
                                </li>
                                <li><a href="https://www.facebook.com/8ezno"><i
                                            class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="#"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @stack('scripts')
    @vite(['resources/js/app.js'])

</body>

</html>
