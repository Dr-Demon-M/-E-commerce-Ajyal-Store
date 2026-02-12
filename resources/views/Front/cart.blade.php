<x-front-layout title="Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title" style="font-size: 1.5rem;">Shopping Cart</h1>
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

    <div class="shopping-cart section" style="padding: 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="cart-list-head shadow-sm border rounded-3 bg-white">
                        <div class="cart-list-title d-none d-md-block px-4 py-2"
                            style="background: #fcfcfc; border-bottom: 1px solid #eee;">
                            <div class="row align-items-center">
                                <div class="col-lg-2 col-md-1"></div>
                                <div class="col-lg-4 col-md-4">
                                    <p class="small fw-bold text-dark mb-0">Product</p>
                                </div>
                                <div class="col-lg-2 col-md-2 text-center">
                                    <p class="small fw-bold text-dark mb-0">Qty</p>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <p class="small fw-bold text-dark mb-0">Subtotal</p>
                                </div>
                                <div class="col-lg-2 col-md-2 text-center">
                                    <p class="small fw-bold text-dark mb-0">Action</p>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $item)
                            <div class="cart-single-list px-4 py-3 border-bottom hover-row transition-all"
                                id="{{ $item->id }}">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-md-1 col-12 text-center mb-2 mb-md-0">
                                        <a href="{{ route('allProduct.show', $item->product->slug) }}">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                class="img-fluid rounded border p-1 bg-white shadow-xs"
                                                style="max-height: 60px;">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mb-2 mb-md-0">
                                        <h6 class="product-name mb-1" style="font-size: 0.95rem;">
                                            <a href="{{ route('allProduct.show', $item->product->slug) }}"
                                                class="text-dark hover-primary fw-600">
                                                {{ $item->product->name }}
                                            </a>
                                        </h6>
                                        <p class="product-des text-muted mb-0" style="font-size: 0.8rem;">
                                            <span class="me-2"><i class="lni lni-tag text-primary"></i>
                                                Mirrorless</span>
                                            <span><i class="lni lni-paint-roller text-primary"></i> Black</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12 mb-2 mb-md-0 text-center">
                                        <div class="count-input px-md-1">
                                            <select class="item-quantity form-select form-select-sm shadow-none"
                                                style="font-size: 0.85rem; height: 32px;" data-id="{{ $item->id }}">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $item->quantity == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-12 mb-2 mb-md-0">
                                        <p class="fw-bold text-primary mb-0" style="font-size: 0.9rem;">
                                            {{ currency($item->quantity * $item->product->price) }}
                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12 text-center">
                                        <a class=" text-danger transition-all hover-scale d-inline-block"
                                            data-id="{{ $item->id }}" href="javascript:void(0)">
                                            <i class="lni lni-trash-can" style="font-size: 1.1rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="lni lni-cart-full text-muted mb-3" style="font-size: 50px; opacity: 0.2;"></i>
                                <h5 class="mb-2">Your cart is empty</h5>
                                <a href="{{ route('home') }}" class="btn btn-primary btn-sm px-4 rounded-pill">Shop
                                    Now</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                    <div class="cart-summary bg-white p-3 shadow-sm border rounded-3">
                        <div class="coupon-section mb-3">
                            <p class="fw-bold mb-2" style="font-size: 0.85rem;"><i class="lni lni-ticket me-1"></i>
                                Promo Code</p>
                            <div class="input-group input-group-sm">
                                <input id="coupon-input" type="text" class="form-control shadow-none"
                                    placeholder="Enter code" value="{{ session('coupon_code') }}">
                                <button id="apply-coupon" class="btn btn-dark btn-sm" type="button">Apply</button>
                            </div>
                            <small id="coupon-message" class="d-block mt-1" style="font-size: 0.75rem;"></small>
                        </div>

                        <hr class="my-3 opacity-25">

                        <div class="price-details" style="font-size: 0.85rem;">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between mb-2 text-muted">
                                    Subtotal <span>{{ currency($total) }}</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2 text-muted">
                                    Shipping <span class="text-success fw-bold">Free</span>
                                </li>
                                @if ($discount > 0)
                                <li class="d-flex justify-content-between mb-2 text-muted">
                                    Discount <span class="text-danger" id="discount-price">-
                                        {{ currency($discount) }}</span>
                                </li>
                                @endif
                                <li class="d-flex justify-content-between border-top pt-2 mt-2">
                                    <strong class="text-dark">Total Amount</strong>
                                    <strong class="text-primary fs-5"
                                        id="total-price">{{ currency($total - $discount) }}</strong>
                                </li>
                            </ul>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('checkout') }}" class="btn btn-primary fw-bold rounded-2 py-2"
                                    style="font-size: 0.9rem;">
                                    Checkout Now
                                </a>
                                <a href="{{ route('home') }}"
                                    class="btn btn-link text-muted btn-sm text-decoration-none"
                                    style="font-size: 0.8rem;">
                                    <i class="lni lni-arrow-left me-1"></i> Back to Shop
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Coupon Logic - Improved feedback
            document.getElementById('apply-coupon').addEventListener('click', async () => {
                const couponInput = document.getElementById('coupon-input');
                const coupon = couponInput.value;
                const message = document.getElementById('coupon-message');
                const btn = document.getElementById('apply-coupon');

                message.textContent = '';
                message.className = 'd-block mt-2 small';

                if (!coupon) {
                    message.textContent = 'Please enter a coupon code';
                    message.classList.add('text-danger');
                    return;
                }

                const originalBtnText = btn.innerText;
                btn.innerText = '...';
                btn.disabled = true;

                try {
                    const response = await fetch("{{ route('checkout.apply-coupon') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            coupon
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) throw new Error(data.message);

                    document.getElementById('discount-price').innerHTML = '- ' + data.discount;
                    document.getElementById('total-price').innerHTML = data.total;

                    message.textContent = 'Success! Coupon applied.';
                    message.classList.add('text-success');

                } catch (e) {
                    message.textContent = e.message;
                    message.classList.add('text-danger');
                } finally {
                    btn.innerText = originalBtnText;
                    btn.disabled = false;
                }
            });
        </script>
    @endpush
    @vite('resources/js/cart.js')
</x-front-layout>
