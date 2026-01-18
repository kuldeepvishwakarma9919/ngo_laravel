@extends('home.masters.layouts.app')

@section('title', 'Membership Payment')

@section('content')

<div class="container py-5 text-center">
    <h3>Membership Payment</h3>
    <p>Amount: ₹{{ $payment->amount }}</p>

    <button id="rzp-button" class="btn btn-success">
        Pay Now
    </button>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "{{ $payment->amount * 100 }}",
    "currency": "INR",
    "name": "NGO Membership",
    "description": "Membership Fee",

    "handler": function (response) {
        window.location.href =
            "{{ route('payment.success') }}" +
            "?payment_db_id={{ $payment->id }}" +
            "&transaction_id=" + response.razorpay_payment_id;
    }
};

var rzp = new Razorpay(options);
document.getElementById('rzp-button').onclick = function (e) {
    rzp.open();
    e.preventDefault();
};
</script>

@endsection
