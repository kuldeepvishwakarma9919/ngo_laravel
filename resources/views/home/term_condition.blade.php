@extends('home.masters.layouts.app')
@section('title', 'Terms & Conditions')
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

        .terms-list {
            padding-left: 20px;
        }

        .terms-list li {
            margin-bottom: 15px;
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
            <h1 class="fw-bold">Terms & Conditions</h1>
            <p>Please read these terms carefully before using our platform.</p>
        </div>
    </div>

    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-section">
                    <p class="last-updated">Last Updated: January 2026</p>

                    <p>Welcome to <strong>{{ $settings->site_name }}</strong>. By accessing this website, you agree to be
                        bound by these Terms and Conditions. If you disagree with any part of these terms, please do not use
                        our website.</p>

                    <h4>1. Use of Website</h4>
                    <p>The content of the pages of this website is for your general information and use only. It is subject
                        to change without notice.</p>
                    <ul class="terms-list">
                        <li>Unauthorized use of this website may give rise to a claim for damages and/or be a criminal
                            offense.</li>
                        <li>You agree not to use this website for any purpose that is unlawful or prohibited by these terms.
                        </li>
                    </ul>

                    <h4>2. Donation Terms</h4>
                    <p>When you make a donation through our website:</p>
                    <ul class="terms-list">
                        <li>You confirm that the funds used for donation are your own and are not from any illegal source.
                        </li>
                        <li>All donations are utilized for the social welfare activities mentioned in our campaigns.</li>
                        <li>Once a donation is successfully made, a digital receipt is generated and sent to your registered
                            email.</li>
                    </ul>

                    <h4>3. Membership & Account</h4>
                    <p>If you apply for membership or create an account:</p>
                    <ul class="terms-list">
                        <li>You are responsible for maintaining the confidentiality of your account details.</li>
                        <li>The NGO reserves the right to cancel membership if any provided information is found to be false
                            or if the member acts against the NGO's mission.</li>
                    </ul>

                    <h4>4. Intellectual Property</h4>
                    <p>This website contains material which is owned by or licensed to
                        <strong>{{ $settings->site_name }}</strong>. This material includes, but is not limited to, the
                        design, layout, look, appearance, and graphics. Reproduction is prohibited other than in accordance
                        with the copyright notice.</p>

                    <h4>5. Limitation of Liability</h4>
                    <p>The NGO shall not be liable for any direct, indirect, incidental, or consequential damages resulting
                        from the use or the inability to use the website or services.</p>

                    <h4>6. Governing Law</h4>
                    <p>Your use of this website and any dispute arising out of such use is subject to the laws of India. Any
                        legal action shall be settled in the jurisdiction of
                        <strong>{{ $settings->city ?? 'Lucknow' }}</strong> courts.</p>

                    <div class="mt-5 p-4 bg-light rounded shadow-sm border-start border-4 border-success">
                        <p class="mb-0 fw-bold">Contact Us:</p>
                        <p class="mb-0 text-muted">If you have any questions about these Terms, please reach out to us at:
                        </p>
                        <p class="text-navy mt-1"><strong>Email:</strong> {{ $settings->email }} | <strong>Phone:</strong>
                            +91 {{ $settings->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
