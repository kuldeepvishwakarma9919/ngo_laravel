@extends('home.masters.layouts.app')
@section('title', 'Member Apply')
@push('styles')
    <style>
        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: -50px;
        }


        /* Donation Cards */
        .payment-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            height: 100%;
            border-top: 5px solid var(--danger);
        }

        .qr-wrapper {
            background: #fff;
            padding: 15px;
            border: 2px solid #f1f1f1;
            border-radius: 15px;
            display: inline-block;
        }

        .bank-details p {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            justify-content: space-between;
        }

        .bank-details b {
            color: var(--navy);
        }

        /* Step Process */
        .step-icon {
            width: 60px;
            height: 60px;
            background: var(--ngo-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 15px;
        }

        /* Custom Donation Amount */
        .amount-option {
            border: 2px solid #ddd;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
            text-align: center;
            background: white;
        }

        .amount-option:hover,
        .amount-option.active {
            border-color: var(--ngo-green);
            background: var(--ngo-green);
            color: white;
        }

        .btn-donate-now {
            background: var(--danger);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 18px;
            border: none;
            box-shadow: 0 10px 20px rgba(204, 0, 0, 0.2);
            transition: 0.3s;
        }

        .btn-donate-now:hover {
            transform: translateY(-3px);
            background: var(--navy);
            color: white;
        }

        .wa-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            z-index: 1000;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush
@section('content')
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">Member Membership Form</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>


    <section class="py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5" data-aos="fade-right" style="height: 320px;">
                    <div class="payment-card text-center mb-4">
                        <h4 class="fw-bold mb-3">Quick Scan & Pay</h4>
                        <div class="qr-wrapper mb-3" style="height: 100px;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=upi://pay?pa=9517048512@upi&pn=NGO%20DEMO"
                                alt="UPI QR" style="height: 100%;">
                        </div>
                        <p class="mb-1 fw-bold">UPI ID: <span class="text-success">9517048512@upi</span></p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg"
                                width="60">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Google_Pay_Logo.svg"
                                width="60">
                        </div>
                    </div>

                    <div class="payment-card" style="border-top-color: var(--ngo-green);">
                        <h4 class="fw-bold mb-4"><i class="fa fa-university me-2 text-success"></i>Bank Transfer</h4>
                        <div class="bank-details">
                            <p>Account Name: <b>NGO DEMO SEVA SAMITI</b></p>
                            <p>Bank: <b>State Bank of India</b></p>
                            <p>A/C Number: <b>XXXXXXXXXXXXX</b></p>
                            <p>IFSC Code: <b>SBIN00XXXXX</b></p>
                            <p>Branch: <b>Aliganj, Lucknow</b></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="payment-card">
                        <h3 class="fw-bold mb-4">Donor Information</h3>
                        <form action="" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 mb-2">
                                    <label class="form-label fw-bold">Choose an Amount (₹)</label>
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3">
                                            <div class="amount-option" onclick="setAmount(501)">501</div>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <div class="amount-option" onclick="setAmount(1100)">1100</div>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <div class="amount-option" onclick="setAmount(2100)">2100</div>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <div class="amount-option active" onclick="setAmount(5100)">5100</div>
                                        </div>
                                    </div>
                                    <input type="number" name="amount" id="amountInput" class="form-control mt-3"
                                        placeholder="Enter Other Amount" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="donor_name" class="form-control" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mobile Number</label>
                                    <input type="tel" name="donor_phone" class="form-control" placeholder="Mobile Number"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="donor_email" class="form-control" placeholder="Email"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">PAN Number (For Tax Receipt)</label>
                                    <input type="text" class="form-control" placeholder="Pan Number">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Message (Optional)</label>
                                    <textarea class="form-control" rows="3" placeholder="Say something inspiring..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Payment Mode</label>
                                    <select name="payment_mode" class="form-control" required>
                                        <option value="UPI">UPI</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="button" id="rzp-button" class="btn-donate-now">Confirm & Pay <i
                                            class="fa fa-heart ms-2"></i></button>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                                <script>
                                    document.getElementById('rzp-button').onclick = function(e) {
                                        e.preventDefault();
                                        let name = $("input[name='donor_name']").val();
                                        let email = $("input[name='donor_email']").val();
                                        let phone = $("input[name='donor_phone']").val();
                                        let amount = $("#amountInput").val();

                                        if (!name || !email || !phone || !amount) {
                                            alert("Kripya saari details bharein.");
                                            return false;
                                        }

                                        let btn = $(this);
                                        btn.prop('disabled', true).html('Processing...');
                                        $.ajax({
                                            url: "{{ route('donate.createOrder') }}",
                                            type: 'POST',
                                            data: {
                                                _token: "{{ csrf_token() }}",
                                                amount: amount
                                            },
                                            success: function(response) {
                                                var options = {
                                                    "key": "{{ $razorpayId ?? 'rzp_test_RxsuJmb5HqR6ze' }}",
                                                    "amount": response.amount,
                                                    "currency": "INR",
                                                    "name": "NGO DEMO SEVA SAMITI",
                                                    "description": "Donation for Cause",
                                                    "order_id": response.order_id,
                                                    "handler": function(res) {
                                                        $.ajax({
                                                            url: "{{ route('donate.submit') }}",
                                                            type: 'POST',
                                                            data: {
                                                                _token: "{{ csrf_token() }}",
                                                                razorpay_payment_id: res.razorpay_payment_id,
                                                                razorpay_order_id: res.razorpay_order_id,
                                                                razorpay_signature: res.razorpay_signature,
                                                                donor_name: name,
                                                                donor_email: email,
                                                                donor_phone: phone,
                                                                amount: amount
                                                            },
                                                            success: function(data) {
                                                                alert(
                                                                    "Shukriya! Aapka donation safaltapurvak mil gaya hai."
                                                                );
                                                                location.reload();
                                                            }
                                                        });
                                                    },
                                                    "modal": {
                                                        "ondismiss": function() {
                                                            btn.prop('disabled', false).html(
                                                                'Confirm & Pay <i class="fa fa-heart ms-2"></i>');
                                                        }
                                                    },
                                                    "prefill": {
                                                        "name": name,
                                                        "email": email,
                                                        "contact": phone
                                                    },
                                                    "theme": {
                                                        "color": "#198754"
                                                    }
                                                };
                                                var rzp1 = new Razorpay(options);
                                                rzp1.open();
                                            },
                                            error: function() {
                                                alert("Order failed. Please try again.");
                                                btn.prop('disabled', false).html('Confirm & Pay');
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" style="">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Donation <span class="text-success">Process</span></h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-icon"><i class="fa fa-qrcode"></i></div>
                    <h5>1. Scan & Pay</h5>
                    <p class="text-muted small">QR code scan karein ya bank details ka use karein.</p>
                </div>
                <div class="col-md-4">
                    <div class="step-icon"><i class="fa fa-share-square"></i></div>
                    <h5>2. Share Details</h5>
                    <p class="text-muted small">Payment ka screenshot WhatsApp par bhein (+91 9517048512).</p>
                </div>
                <div class="col-md-4">
                    <div class="step-icon"><i class="fa fa-file-invoice"></i></div>
                    <h5>3. Get Receipt</h5>
                    <p class="text-muted small">Aapko 24 ghante mein official receipt mil jayegi.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function setAmount(value) {
            document.getElementById('amountInput').value = value;

            document.querySelectorAll('.amount-option').forEach(el => {
                el.classList.remove('active');
            });

            event.target.classList.add('active');
        }
    </script>
@endsection
