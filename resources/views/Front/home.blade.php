<x-front-layout>

    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            @foreach ($slider as $single_slide)
                                <!-- Start Single Slider -->
                                <div class="single-slider"
                                    style="background-image: url('{{ $single_slide->image_url }}');">
                                    <div class="content">
                                        <h2>
                                            {{ $single_slide->name }}
                                        </h2>
                                        <p style="color:white !important">{{ $single_slide->description }}</p>
                                        <h3><span>Now Only</span> {{ Currency($single_slide->price) }}</h3>
                                        <div class="button">
                                            <a href="{{ route('product.show', "$single_slide->slug") }}"
                                                class="btn">Show Product</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slider -->
                            @endforeach
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        @foreach ($new as $product)
                            <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                                <!-- Start Small Banner -->
                                <div class="hero-small-banner"
                                    style="background-image: url('{{ $product->image_url }}');">
                                    <div class="content">
                                        <h2>
                                            <span>Arrival New</span>
                                            {{ $product->name }}
                                        </h2>
                                        <h3>{{ currency($product->price) }}</h3>
                                    </div>
                                </div>
                                <!-- End Small Banner -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->


    <!-- Start Banner Area -->
    <section class="banner section">
        <div class="container">
            <div class="row">
                @foreach ($largeBanner as $product)
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="single-banner custom-responsive-margin"
                            style="background-image:url('{{ $product->image_url }}')">
                            <div class="content">
                                <h2>{{ $product->name }}</h2>
                                <p style="color:white !important">{{ $product->description }}</p>
                                <div class="button">
                                    <a href="{{ route('product.show', "$single_slide->slug") }}" class="btn">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Product</h2>
                        <p>Discover our most popular products, handpicked based on customer favorites and top sales.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($trending as $product)
                    <x-front.product-Card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Special Offer -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Special Offer</h2>
                        <p>Don’t miss our special offers — limited-time discounts on selected products.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach ($bestOffer as $product)
                            <div class="col-lg-4 col-md-4 col-12">
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-image">
                                        <img src="{{ $product->image_url }}" alt="#">
                                        <div class="button">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="button">
                                                    <button type="submit" class="btn"><i class="lni lni-cart"></i>
                                                        Add to Cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <span class="category">{{ $product->category->name }}</span>
                                        <h4 class="title">
                                            <a
                                                href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h4>
                                        <ul class="review">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><span>5.0 Review(s)</span></li>
                                        </ul>
                                        <div class="price">
                                            <span>{{ currency($product->price) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Start Banner -->
                    <div class="single-banner right"
                        style="background-image:url('{{ $specialCard->image_url }}');margin-top: 30px;">
                        <div class="content">
                            <h2>{{ $specialCard->name }}</h2>
                            <p style="color:white !important">{{ $specialCard->description }}</p>
                            <div class="price">
                                <span>{{ currency($specialCard->price) }}</span>
                            </div>
                            <div class="button">
                                <a href="{{ route('product.show', "$specialCard->slug") }}" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ $specialCard2->image_url }}" alt="#">
                            <span class="sale-tag">{{ $specialCard2->sale_percent }}%</span>
                        </div>
                        <div class="text">
                            <h2><a
                                    href="{{ route('product.show', "$specialCard2->slug") }}">{{ $specialCard2->name }}</a>
                            </h2>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                <span>{{ currency($specialCard2->price) }}</span>
                                @if ($specialCard2->compare_price)
                                    <span class="discount-price"> {{ currency($specialCard2->compare_price) }}</span>
                                @endif
                            </div>
                            <p style="color:white !important">{{ $specialCard2->description }}</p>
                        </div>
                        <div class="box-head">
                            <div class="box">
                                <h1 id="days">000</h1>
                                <h2 id="daystxt">Days</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">00</h1>
                                <h2 id="hourstxt">Hours</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">00</h1>
                                <h2 id="minutestxt">Minutes</h2>
                            </div>
                            <div class="box">
                                <h1 id="seconds">00</h1>
                                <h2 id="secondstxt">Secondes</h2>
                            </div>
                        </div>
                        <div style="background: rgb(204, 24, 24);" class="alert">
                            <h1 style="padding: 50px 80px;color: white;">We are sorry, Event ended ! </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Special Offer -->

    <!-- Start Home Product List -->
    <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>
                    <!-- Start Single List -->
                    @foreach ($bestSellers as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product.show', "$product->slug") }}"><img
                                        src="{{ $product->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product.show', "$product->slug") }}">{{ $product->name }}</a>
                                </h3>
                                <span>{{ currency($product->price) }}</span>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single List -->
                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">New Arrivals</h4>
                    <!-- Start Single List -->
                    @foreach ($newArrival as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product.show', "$product->slug") }}"><img
                                        src="{{ $product->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product.show', "$product->slug") }}">{{ $product->name }}</a>
                                </h3>
                                <span>{{ currency($product->price) }}</span>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single List -->
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>
                    <!-- Start Single List -->
                    @foreach ($topRated as $product)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('product.show', "$product->slug") }}"><img
                                        src="{{ $product->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('product.show', "$product->slug") }}">{{ $product->name }}</a>
                                </h3>
                                <span>{{ currency($product->price) }}</span>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single List -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Home Product List -->

    <!-- Start Brands Area -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Popular Brands</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    @foreach ($brandImage as $product)
                        <div class="brand-logo">
                            <img src="{{ asset('storage/' . $product->logo_image) }}" alt="#">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Brands Area -->

    <!-- Start Blog Section Area -->
    <section class="blog-section section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest News</h2>
                        <p>There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="https://placehold.co/370x215" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">eCommerce</a>
                            <h4>
                                <a href="blog-single-sidebar.html">What information is needed for shipping?</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="https://placehold.co/370x215" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">Gaming</a>
                            <h4>
                                <a href="blog-single-sidebar.html">Interesting fact about gaming consoles</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="https://placehold.co/370x215" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">Electronic</a>
                            <h4>
                                <a href="blog-single-sidebar.html">Electronics, instrumentation & control engineering
                                </a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Section Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

    @push('scripts')
        <script type="text/javascript">
            //========= Hero Slider 
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });

            //======== Brand Slider
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 15,
                nav: false,
                controls: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    540: {
                        items: 3,
                    },
                    768: {
                        items: 5,
                    },
                    992: {
                        items: 6,
                    }
                }
            });
        </script>
        <script>
            const finaleDate = new Date("February 15, 2026 00:00:00").getTime();

            const timer = () => {
                const now = new Date().getTime();
                let diff = finaleDate - now;
                if (diff < 0) {
                    document.querySelector('.alert').style.display = 'block';
                    // document.querySelector('.container').style.display = 'none';
                }

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
                let seconds = Math.floor(diff % (1000 * 60) / 1000);

                days <= 99 ? days = `0${days}` : days;
                days <= 9 ? days = `00${days}` : days;
                hours <= 9 ? hours = `0${hours}` : hours;
                minutes <= 9 ? minutes = `0${minutes}` : minutes;
                seconds <= 9 ? seconds = `0${seconds}` : seconds;

                document.querySelector('#days').textContent = days;
                document.querySelector('#hours').textContent = hours;
                document.querySelector('#minutes').textContent = minutes;
                document.querySelector('#seconds').textContent = seconds;

            }
            timer();
            setInterval(timer, 1000);
        </script>
    @endpush
</x-front-layout>
