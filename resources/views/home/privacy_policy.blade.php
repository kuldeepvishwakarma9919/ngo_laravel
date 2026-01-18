@extends('home.masters.layouts.app')
@section('title', 'Privacy Policy')
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
            <h1 class="fw-bold">Privacy Policy</h1>
            <p>Your privacy is important to us. Learn how we protect your data.</p>
        </div>
    </div>

    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-section">
                    <p class="last-updated">Last Updated: January 2026</p>

                    <p>Welcome to <strong>{{ $settings->site_name }}</strong>. We are committed to protecting your personal
                        information and your right to privacy. If you have any questions or concerns about our policy, or
                        our practices with regards to your personal information, please contact us at
                        {{ $settings->email }}.</p>

                    <h4>1. Information We Collect</h4>
                    <p>We collect personal information that you voluntarily provide to us when registering on the website,
                        expressing an interest in obtaining information about us or our services, or making a donation. This
                        includes:</p>
                    <ul>
                        <li><strong>Personal Data:</strong> Name, email address, phone number, and mailing address.</li>
                        <li><strong>Payment Data:</strong> We use secure payment gateways (like Razorpay) for donations. We
                            do not store your credit card or bank details on our servers.</li>
                    </ul>

                    <h4>2. How We Use Your Information</h4>
                    <p>We use the information we collect for the following purposes:</p>
                    <ul>
                        <li>To process your donations and provide tax-exempt receipts (80G).</li>
                        <li>To send you updates about the NGO's campaigns and newsletters.</li>
                        <li>To improve our website functionality and user experience.</li>
                    </ul>

                    <h4>3. Data Protection</h4>
                    <p>We implement a variety of security measures to maintain the safety of your personal information. Your
                        personal information is contained behind secured networks and is only accessible by a limited number
                        of persons who have special access rights to such systems.</p>

                    <h4>4. Third-Party Sharing</h4>
                    <p>We do not sell, trade, or otherwise transfer to outside parties your personally identifiable
                        information. This does not include trusted third parties who assist us in operating our website
                        (like payment processors), as long as those parties agree to keep this information confidential.</p>

                    <h4>5. Cookies Policy</h4>
                    <p>We may use cookies to understand and save your preferences for future visits. You can choose to have
                        your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies
                        via your browser settings.</p>

                    <h4>6. Consent</h4>
                    <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                    <div class="mt-5 p-3 bg-light rounded text-center">
                        <p class="mb-0">If you have any questions regarding this privacy policy, you may contact us using
                            the information below:</p>
                        <p class="fw-bold text-navy mt-2">{{ $settings->address }} | {{ $settings->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
