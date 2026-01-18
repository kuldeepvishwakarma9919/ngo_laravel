@extends('home.masters.layouts.app')
@section('content')
<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 mt-5">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Donate to: {{ $campaign->title }}</h4>
                    <form id="donationForm">
                        <input type="hidden" id="campaign_id" value="{{ $campaign->id }}">
                        
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" id="donor_name" class="form-control" required placeholder="John Doe">
                        </div>
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" id="donor_email" class="form-control" required placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" id="donor_phone" class="form-control" required placeholder="9876543210">
                        </div>
                        <div class="mb-3">
                            <label>Amount (INR)</label>
                            <input type="number" id="amount" class="form-control" required>
                        </div>
                        
                        <button type="button" class="btn btn-success w-100 py-3 fw-bold" onclick="startPayment()">
                            PROCEED TO PAY
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function startPayment() {
    let amount = document.getElementById('amount').value;
    let name = document.getElementById('donor_name').value;
    
    if(!name || !amount) { alert("Please fill all details"); return; }

    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}", 
        "amount": amount * 100, 
        "currency": "INR",
        "name": "NGO Mission",
        "handler": function (response) {
            processBackendDonation(response.razorpay_payment_id);
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
}

function processBackendDonation(paymentId) {
    let formData = {
        donor_name: document.getElementById('donor_name').value,
        donor_email: document.getElementById('donor_email').value,
        donor_phone: document.getElementById('donor_phone').value,
        amount: document.getElementById('amount').value,
        campaign_id: document.getElementById('campaign_id').value,
        payment_id: paymentId,
        _token: "{{ csrf_token() }}"
    };

    fetch("{{ route('donation.save') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "Accept": "application/json" },
        body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.href = "/donation/receipt/" + data.receipt_no;
        }
    });
}
</script>
@endsection