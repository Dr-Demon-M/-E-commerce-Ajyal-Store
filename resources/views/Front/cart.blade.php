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
                            <li><a href="#">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head ">
                <!-- Cart List Title -->
                <div class="cart-list-title ">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                @foreach ($cart as $item)
                    <!-- Cart Single List list -->
                    <div class="cart-single-list" id="{{ $item->id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('allProduct.show', $item->product->slug) }}"><img
                                        src="{{ $item->product->image_url }}" alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="{{ route('allProduct.show', $item->product->slug) }}">
                                        {{ $item->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <select class="item-quantity input-group" data-id="{{ $item->id }}"
                                        style="width:50%">
                                        <option value="1" {{ $item->quantity == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $item->quantity == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $item->quantity == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $item->quantity == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $item->quantity == 5 ? 'selected' : '' }}>5</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ currency($item->quantity * $item->product->price) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>$0.00</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" data-id="{{ $item->id }}" href="javascript:void(0)"><i
                                        class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List list -->
                @endforeach
                @if ($cart->count() == 0)
                    <div class="card border-0 shadow-sm text-center my-4">
                        <div class="card-body py-5">
                            <h4 class="mb-2">Your cart is empty 🛒</h4>
                            <p class="text-muted mb-4">
                                Even your cart is on a diet today… add some snacks (products) 😅
                            </p>

                            <a href="{{ route('home') }}" class="btn btn-primary">
                                Go Shopping
                            </a>
                        </div>
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="{{ route('cart.index') }}" method="get">
                                            <input type="text" name="coupon" placeholder="Enter Your Coupon"
                                                value="{{ session('coupon') }}">
                                            <div class="button">
                                                <button class="btn" type="submit">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span id="cart-total">{{ currency($total) }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You
                                            Save<span>{{ currency(session('discount')) }}</span>
                                        </li>
                                        <li class="last">You
                                            Pay<span>{{ currency($total - session('discount')) }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ route('home') }}" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
    @vite('resources/js/cart.js')
</x-front-layout>
