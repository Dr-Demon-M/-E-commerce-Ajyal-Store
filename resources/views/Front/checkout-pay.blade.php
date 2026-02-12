<x-front-layout>

    <div class="container py-5">
        <h2 class="mb-4">Pay with Card</h2>

        <div id="checkout"></div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe(
                "{{ config('services.stripe.publishable_key') }}"
            );

            initialize();

            async function initialize() {
                const fetchClientSecret = async () => {
                    const response = await fetch(
                        "{{ route('stripe.session') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        }
                    );

                    const data = await response.json();
                    return data.clientSecret;
                };

                const checkout = await stripe.initEmbeddedCheckout({
                    fetchClientSecret,
                });

                checkout.mount('#checkout');
            }
        </script>
    @endpush

</x-front-layout>
