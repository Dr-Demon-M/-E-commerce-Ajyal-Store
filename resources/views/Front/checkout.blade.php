<x-front-layout>
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Checkout</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="index.html">Shop</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>


    <section class="checkout-wrapper section" style="background-color: #f4f7f9;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <ul id="accordionExample">
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">
                                        <i class="lni lni-user me-2"></i> Your Personal Details
                                    </h6>
                                    <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Full Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[billing][first_name]" placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[billing][last_name]" placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][email]" placeholder="Email Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][phone_number]" placeholder="Phone Number" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Street Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][street_address]" placeholder="Street Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[billing][postal_code]" placeholder="Post Code" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Governorate</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[billing][governorate]" :options="$governorate" placeholder="Select Governorate" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[billing][city]" :options="$cities" placeholder="Select City" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mt-3 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="same-address" name="same_address" style="cursor: pointer;">
                                                    <label class="form-check-label" for="same-address" style="cursor: pointer; user-select: none;">
                                                        My delivery and mailing addresses are the same.
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form button text-end">
                                                    <button class="btn btn-primary" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseFour" type="button">
                                                        Next Step <i class="lni lni-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>

                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        <i class="lni lni-delivery me-2"></i> Shipping Address
                                    </h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Full Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[shipping][first_name]" placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="address[shipping][last_name]" placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][email]" placeholder="Email Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][phone_number]" placeholder="Phone Number" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Street Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][street_address]" placeholder="Street Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="address[shipping][postal_code]" placeholder="Post Code" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Governorate</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[shipping][governorate]" :options="$governorate" placeholder="Select Governorate" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="address[shipping][city]" :options="$cities" placeholder="Select City" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button d-flex justify-content-between">
                                                    <button class="btn btn-secondary" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree" type="button">Previous</button>
                                                    <a href="javascript:void(0)" class="btn btn-alt"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                                        aria-expanded="false" aria-controls="collapsefive">
                                                        Save & Continue <i class="lni lni-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>

                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsefive" aria-expanded="false"
                                        aria-controls="collapsefive">
                                        <i class="lni lni-credit-cards me-2"></i> Payment Info
                                    </h6>
                                    <section class="checkout-steps-form-content collapse" id="collapsefive"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="checkout-payment-form">
                                                    <p class="mb-3 text-muted">Please select your preferred payment method:</p>
                                                    
                                                    <button type="submit" name="payment_method" value="Visa" class="payment-option-btn">
                                                        <span>Pay with Visa / MasterCard</span>
                                                        <i class="lni lni-visa"></i>
                                                    </button>

                                                    <button type="submit" name="payment_method" value="Cod" class="payment-option-btn">
                                                        <span>Cash On Delivery (COD)</span>
                                                        <i class="lni lni-package"></i>
                                                    </button>
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
                        <div class="checkout-sidebar-coupon mb-4">
                            <h5 class="title mb-3">Have a Coupon?</h5>
                            <form action="{{ route('checkout') }}" method="POST">
                                <div class="single-form form-default">
                                    <div class="form-input form mb-2">
                                        <input id="coupon-input" name='coupon' placeholder="Enter Coupon Code"
                                            value="{{ session('coupon_code') }}" style="width: 100%;">
                                    </div>
                                    <small id="coupon-message" class="d-block mb-2 font-weight-bold"></small>
                                    <div class="button">
                                        <button id="apply-coupon" class="btn btn-outline-primary w-100" type="button">Apply Coupon</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="checkout-sidebar-price-table">
                            <h5 class="title">Order Summary</h5>
                            <div class="sub-total-price">
                                <div class="total-price d-flex justify-content-between mb-2">
                                    <p class="value text-muted">Subtotal Price:</p>
                                    <p class="price font-weight-bold">{{ currency($cart->total()) }}</p>
                                </div>
                                <div class="total-price shipping d-flex justify-content-between mb-2">
                                    <p class="value text-muted">Shipping Cost:</p>
                                    <p class="price font-weight-bold">{{ Currency(0) }}</p>
                                </div>
                                <div class="total-price saving d-flex justify-content-between mb-2" style="color: #d31a1a;">
                                    <p class="value">You Save:</p>
                                    <p class="price" id="discount-price">{{ currency(session('discount')) }}</p>
                                </div>
                            </div>

                            <div class="total-payable d-flex justify-content-between align-items-center">
                                <p class="value">Total Payable:</p>
                                <p class="price" id="total-price">{{ currency($cart->total() - session('discount')) }}</p>
                            </div>
                            
                            <div class="mt-3 text-center">
                                <small class="text-muted"><i class="lni lni-protection"></i> Secure Checkout</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            const sameAddressCheckbox = document.getElementById('same-address');
            const fields = [
                'first_name', 'last_name', 'email', 'phone_number',
                'street_address', 'postal_code', 'governorate', 'city'
            ];

            function syncShippingFields(isChecked) {
                fields.forEach(field => {
                    const billing = document.querySelector(`[name="address[billing][${field}]"]`);
                    const shipping = document.querySelector(`[name="address[shipping][${field}]"]`);
                    
                    if (!billing || !shipping) return;

                    if (isChecked) {
                        shipping.value = billing.value;
                        shipping.setAttribute('readonly', true);
                        if (shipping.tagName === 'SELECT') {
                            // للـ Select boxes، نقوم بتعطيل التفاعل البصري ولكن نبقي القيمة
                            shipping.style.pointerEvents = 'none';
                            shipping.style.backgroundColor = '#e9ecef';
                        }
                    } else {
                        shipping.removeAttribute('readonly');
                        shipping.style.pointerEvents = '';
                        shipping.style.backgroundColor = '';
                        shipping.value = ''; // تفريغ الحقل أو تركه كما كان (حسب الرغبة)
                    }
                    
                    // Trigger change event just in case other scripts listen to it
                    shipping.dispatchEvent(new Event('change'));
                });
            }

            // عند الضغط على الـ Checkbox
            sameAddressCheckbox.addEventListener('change', function() {
                syncShippingFields(this.checked);
            });

            // الاستماع للتغييرات في حقول الفاتورة لتحديث الشحن فوراً إذا كان الـ Checkbox مفعلاً
            fields.forEach(field => {
                const billing = document.querySelector(`[name="address[billing][${field}]"]`);
                if (billing) {
                    billing.addEventListener('input', () => {
                        if (sameAddressCheckbox.checked) {
                            syncShippingFields(true);
                        }
                    });
                    // للـ Select boxes
                    billing.addEventListener('change', () => {
                        if (sameAddressCheckbox.checked) {
                            syncShippingFields(true);
                        }
                    });
                }
            });
        </script>

        <script>
            // Coupon Logic - kept largely same but with UI tweaks handling
            document.getElementById('apply-coupon').addEventListener('click', async () => {
                const couponInput = document.getElementById('coupon-input');
                const coupon = couponInput.value;
                const message = document.getElementById('coupon-message');
                const btn = document.getElementById('apply-coupon');

                message.textContent = '';
                message.className = 'd-block mt-1';
                
                if (!coupon) {
                    message.textContent = 'Please enter a coupon code';
                    message.classList.add('text-danger');
                    return;
                }

                // UI Loading state
                const originalBtnText = btn.innerText;
                btn.innerText = 'Applying...';
                btn.disabled = true;

                try {
                    const response = await fetch("{{ route('checkout.apply-coupon') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ coupon })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message);
                    }

                    document.getElementById('discount-price').innerHTML = data.discount;
                    document.getElementById('total-price').innerHTML = data.total;

                    message.textContent = 'Coupon applied successfully!';
                    message.classList.remove('text-danger');
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
</x-front-layout>