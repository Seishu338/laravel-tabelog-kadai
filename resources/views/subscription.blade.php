@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <form id="setup-form" action="{{ route('subscribe.post') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>サブスクリプション商品:</label>
                    <select id="plan" name="plan" class="form-control">
                        <option value="Stripeの商品ページにあるAPI_ID">テストプレミアムプラン</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="card-holder-name">支払い情報:</label>
                    <div>
                        <input id="card-holder-name" class="form-control" type="text" placeholder="カード名義人">
                    </div>
                    <div id="card-element" class="w-100">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <input type="hidden" id="stripeToken" name="stripeToken">

                <div id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-primary mt-5" data-secret="">Submit Payment</div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51Ob0o2LwuQueWUBuzMee6UkHKp5u7sI3mAskhojMDfBExiTQCCXYrOE3n06zi0QPK2YzO0jiLmfysdA6hgPZwVuw00PIGHPd57');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            console.log(error);
        } else {
            // The card has been verified successfully...
            stripePaymentIdHandler(setupIntent.payment_method);
        }
    });


    function stripePaymentIdHandler(paymentMethodId) {
        // Insert the paymentMethodId into the form so it gets submitted to the server
        const form = document.getElementById('setup-form');

        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'paymentMethodId');
        hiddenInput.setAttribute('value', paymentMethodId);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
@endpush
@endsection