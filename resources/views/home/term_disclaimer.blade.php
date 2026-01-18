@extends('home.masters.layouts.app')
@section('title', 'Disclaimer')
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
        .disclaimer-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 10px;
            font-style: italic;
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
            <h1 class="fw-bold">Legal Disclaimer</h1>
            <p>Information about our website's liability and data accuracy.</p>
        </div>
    </div>

    <div class="container " style="margin-top: 100px; margin-bottom: 100px">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-section">
                    <p class="last-updated">Last Updated: January 2026</p>

                    <div class="disclaimer-box mb-4">
                        "The information provided by <strong>{{ $settings->site_name }}</strong> on this website is for general informational purposes only. All information is provided in good faith, however we make no representation or warranty of any kind."
                    </div>

                    <h4>1. Professional Advice</h4>
                    <p>The information on this website is not intended to be a substitute for professional advice. Whether it's legal, financial, or medical information related to our campaigns, we encourage you to consult with the appropriate professionals before taking any action based on such information.</p>

                    <h4>2. External Links Disclaimer</h4>
                    <p>Our website may contain links to external websites that are not provided or maintained by or in any way affiliated with <strong>{{ $settings->site_name }}</strong>. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>

                    <h4>3. Errors and Omissions</h4>
                    <p>While we strive to keep the information up to date and correct, the NGO assumes no responsibility for errors or omissions in the contents of the Service. In no event shall the NGO be liable for any special, direct, indirect, consequential, or incidental damages.</p>

                    <h4>4. Tax Exemption Disclaimer</h4>
                    <p>Donations made to our NGO are eligible for tax deduction under Section 80G of the Income Tax Act, as per current government rules. However, <strong>{{ $settings->site_name }}</strong> is not responsible if a donor's claim is rejected by the tax authorities due to incorrect information provided by the donor or changes in government policy.</p>

                    <h4>5. "Use at Your Own Risk"</h4>
                    <p>All information in the Service is provided "as is", with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied.</p>

                    <div class="mt-5 p-4 bg-light rounded shadow-sm text-center">
                        <h5 class="fw-bold">Questions?</h5>
                        <p class="text-muted mb-0">If you require any more information or have any questions about our site's disclaimer, please feel free to contact us.</p>
                        <p class="text-navy fw-bold mt-2">Email: {{ $settings->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection