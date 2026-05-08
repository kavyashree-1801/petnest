@extends('layouts.app')

@section('content')

<div class="container text-center mt-5">

<h2>Complete Payment</h2>
<h4>Total: ₹{{ $order->total }}</h4>

<!-- ⏱ TIMER -->

<h5 id="timer" class="text-danger mt-3"></h5>

<button id="pay-btn" class="btn btn-success mt-3">Pay Now</button>

<form id="payment-form" method="POST" action="/payment/verify">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="payment_id">
    <input type="hidden" name="razorpay_order_id" id="order_id">
    <input type="hidden" name="razorpay_signature" id="signature">
</form>

</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
let expiryTime = new Date("{{ $order->created_at->addMinutes(15)->format('Y-m-d H:i:s') }}").getTime();

let timer = setInterval(function () {

    let now = new Date().getTime();
    let distance = expiryTime - now;

    if (distance <= 0) {
        clearInterval(timer);

        document.getElementById("timer").innerHTML = "Payment Expired ❌";

        // ❌ Disable button
        document.getElementById("pay-btn").disabled = true;

        // 🔁 Redirect after 2 sec
        setTimeout(() => {
            window.location.href = "/orders";
        }, 2000);

        return;
    }

    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML =
        "Expires in: " + minutes + "m " + seconds + "s";

}, 1000);

// Razorpay
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": {{ $order->total * 100 }},
    "currency": "INR",
    "name": "PetNest",
    "description": "Order Payment",
    "order_id": "{{ $razorpayOrderId }}",

    "handler": function (response){
        document.getElementById('payment_id').value = response.razorpay_payment_id;
        document.getElementById('order_id').value = response.razorpay_order_id;
        document.getElementById('signature').value = response.razorpay_signature;

        document.getElementById('payment-form').submit();
    }
};

var rzp = new Razorpay(options);

document.getElementById('pay-btn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

@endsection
