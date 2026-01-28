<x-front-layout>
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">checkout</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="index.html">Shop</a></li>
                            <li>checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!--====== Checkout Form Steps Part Start ======-->

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <ul id="accordionExample">
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">Your Personal Details </h6>
                                    <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[billing][first_name]"
                                                                placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[billing][last_name]"
                                                                placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][email]"
                                                            placeholder="Email Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][phone_number]"
                                                            placeholder="Phone Number" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Street Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][street_address]"
                                                            placeholder="Street Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][postal_code]"
                                                            placeholder="Post Code" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Governorates</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[billing][governorate]"
                                                            :options="$governorate" placeholder="Country" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[billing][city]" :options="$cities"
                                                            placeholder="Country" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" id="same-address" name="same_address">
                                                    <label for="same-address"><span></span></label>
                                                    <p>My delivery and mailing addresses are the same.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form button">
                                                    <button class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseFour" type="button">next
                                                        step</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[shipping][first_name]"
                                                                placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[shipping][last_name]"
                                                                placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][email]"
                                                            placeholder="Email Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][phone_number]"
                                                            placeholder="Phone Number" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Street Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][street_address]"
                                                            placeholder="Street Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][postal_code]"
                                                            placeholder="Post Code" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Governorate</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[shipping][governorate]"
                                                            :options="$governorate" placeholder="Country" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[shipping][city]" :options="$cities"
                                                            placeholder="Country" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="heading-6 font-weight-400 payment-title">Select Delivery
                                                        Option</h6>
                                                    <div class="payment-option-wrapper">
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" checked
                                                                id="shipping-1">
                                                            <label for="shipping-1">`
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-2">
                                                            <label for="shipping-2">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-3">
                                                            <label for="shipping-3">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-4">
                                                            <label for="shipping-4">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree" type="button">previous</button>
                                                    <a href="javascript:void(0)" class="btn btn-alt"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                                        aria-expanded="false" aria-controls="collapsefive">
                                                        Save & Continue
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsefive" aria-expanded="false"
                                        aria-controls="collapsefive">Payment Info</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapsefive"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="checkout-payment-form">
                                                    <div class="single-form form-default">
                                                        <label>Cardholder Name</label>
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="Cardholder Name">
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default">
                                                        <label>Card Number</label>
                                                        <div class="form-input form">
                                                            <input id="credit-input" type="text"
                                                                placeholder="0000 0000 0000 0000">
                                                            <img src="assets/images/payment/card.png" alt="card">
                                                        </div>
                                                    </div>
                                                    <div class="payment-card-info">
                                                        <div class="single-form form-default mm-yy">
                                                            <label>Expiration</label>
                                                            <div class="expiration d-flex">
                                                                <div class="form-input form">
                                                                    <input type="text" placeholder="MM">
                                                                </div>
                                                                <div class="form-input form">
                                                                    <input type="text" placeholder="YYYY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-form form-default">
                                                            <label>CVC/CVV <span><i
                                                                        class="mdi mdi-alert-circle"></i></span></label>
                                                            <div class="form-input form">
                                                                <input type="text" placeholder="***">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default button">
                                                        <button type="submit" class="btn">pay now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <form action="{{ route('checkout') }}" method="get">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input name='coupon' placeholder="Coupon Code"
                                            value="{{ session('coupon') }}">
                                    </div>
                                    <div class="button">
                                        <button class="btn" type="submit">apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">Pricing Table</h5>

                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price">{{ currency($cart->total()) }}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">Shipping Price:</p>
                                    <p class="price">{{ Currency(0) }}</p>
                                </div>
                                <div class="total-price saving">
                                    <p class="value">You Save:</p>
                                    <p class="price">{{ currency(session('discount')) }}</p>
                                </div>
                            </div>

                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Total Price:</p>
                                    <p class="price">{{ currency($cart->total() - session('discount')) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Checkout Form Steps Part Ends ======-->
    @push('scripts')
        <script>
            const sameAddressCheckbox = document.getElementById('same-address');
            const fields = [
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'street_address',
                'postal_code',
                'governorate',
                'city'
            ];

            function syncShippingFields(disabled) {
                fields.forEach(field => {
                    const billing = document.querySelector(`[name="address[billing][${field}]"]`);
                    const shipping = document.querySelector(`[name="address[shipping][${field}]"]`);
                    if (!billing || !shipping) return;
                    if (disabled) {
                        shipping.value = billing.value;
                        if (shipping.tagName === 'INPUT' || shipping.tagName === 'TEXTAREA') {
                            shipping.readOnly = true;
                        }
                        if (shipping.tagName === 'SELECT') {
                            shipping.style.pointerEvents = 'none';
                            shipping.style.backgroundColor = '#eee';
                        }
                    } else {
                        if (shipping.tagName === 'INPUT' || shipping.tagName === 'TEXTAREA') {
                            shipping.readOnly = false;
                        }
                        if (shipping.tagName === 'SELECT') {
                            shipping.style.pointerEvents = '';
                            shipping.style.backgroundColor = '';
                        }
                        shipping.value = '';
                    }
                    shipping.dispatchEvent(new Event('change'));
                });
            }

            sameAddressCheckbox.addEventListener('change', function() {
                syncShippingFields(this.checked);
            });

            fields.forEach(field => {
                const billing = document.querySelector(
                    `[name="address[billing][${field}]"]`
                );
                if (!billing) return;
                billing.addEventListener('input', () => {
                    if (sameAddressCheckbox.checked) {
                        syncShippingFields(true);
                    }
                });
            });
        </script>
    @endpush

</x-front-layout>
