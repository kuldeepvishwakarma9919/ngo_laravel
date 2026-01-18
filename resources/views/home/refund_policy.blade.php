@extends('home.masters.layouts.app')
@section('title', 'Refund Policy')
@push('styles')
    <style>
        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .content-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            line-height: 1.8;
            color: #444;
        }
        .content-section h4 {
            color: var(--navy);
            font-weight: 700;
            margin-top: 25px;
            border-left: 4px solid var(--ngo-green);
            padding-left: 15px;
        }
        .policy-alert {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 8px;
            font-weight: 500;
        }
        .last-updated {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">Refund & Cancellation</h1>
            <p>Transparency is our priority. Know about our donation refund process.</p>
        </div>
    </div>

    <div class="container" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-section">
                    <p class="last-updated">Last Updated: January 2026</p>

                    <div class="policy-alert">
                        <i class="fa fa-exclamation-triangle me-2"></i> 
                        Please Note: Donations once made are generally non-refundable as they are immediately allocated to social welfare projects.
                    </div>

                    <p>At <strong>{{ $settings->site_name }}</strong>, we value every contribution made towards our mission. We understand that sometimes errors can occur during the donation process. This policy outlines how such situations are handled.</p>

                    <h4>1. Donation Refunds</h4>
                    <p>We do not encourage refunds for donations made voluntarily. However, we will consider a refund request in the following exceptional cases:</p>
                    <ul>
                        <li>If a duplicate transaction occurred due to a technical error on the website or payment gateway.</li>
                        <li>If an unauthorized person made a donation using your card/bank account without your consent (subject to bank verification).</li>
                        <li>If you accidentally entered an incorrect amount (e.g., ₹10,000 instead of ₹1,000).</li>
                    </ul>

                    <h4>2. How to Request a Refund</h4>
                    <p>Refund requests must be submitted within <strong>7 days</strong> from the date of the transaction. To request a refund, please email us at <strong>{{ $settings->email }}</strong> with the following details:</p>
                    <ul>
                        <li>Full Name of the Donor</li>
                        <li>Date of Donation</li>
                        <li>Donation Amount</li>
                        <li>Transaction ID / Receipt Number</li>
                        <li>Reason for the Refund</li>
                    </ul>

                    <h4>3. Processing Time</h4>
                    <p>Once your request is received and verified, we will process the refund within <strong>10 to 15 working days</strong>. The amount will be credited back to the original payment method (Credit Card, Debit Card, or Bank Account) used at the time of donation.</p>

                    <h4>4. Cancellation of Monthly Donations</h4>
                    <p>If you have signed up for a recurring/monthly donation program, you can cancel your subscription at any time. To cancel, please log in to your dashboard or send an email to our support team at least 5 days before the next scheduled payment.</p>

                    <h4>5. Tax Receipts and Refunds</h4>
                    <p>If an 80G tax-exempt receipt has already been issued and sent to the donor, the refund will only be processed after the donor provides a written confirmation that the original receipt will not be used for tax claims.</p>

                    <div class="mt-5 p-4 border rounded bg-light text-center">
                        <h5>Need Help?</h5>
                        <p class="text-muted">If you have any questions regarding our refund policy, feel free to contact our finance team.</p>
                        <a href="mailto:{{ $settings->email }}" class="btn btn-outline-success">
                            <i class="fa fa-envelope me-2"></i> Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection