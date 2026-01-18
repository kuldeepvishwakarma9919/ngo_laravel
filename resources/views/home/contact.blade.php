@extends('home.masters.layouts.app')
@section('title', 'Contact')
@push('styles')
    <style>
        .contact-hero {
            background: linear-gradient(rgba(26, 42, 108, 0.8), rgba(204, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1534536281715-e28d76689b4d?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
            clip-path: ellipse(150% 100% at 50% 0%);
        }


        .contact-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            height: 100%;
            padding: 30px;
            background: white;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            border-bottom: 4px solid var(--ngo-green);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--ngo-green);
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #eee;
        }

        .form-control:focus {
            border-color: var(--ngo-green);
            box-shadow: none;
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #111;
            color: #ccc;
            font-size: 14px;
        }

        footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 25px;
            border-left: 3px solid var(--accent);
            padding-left: 10px;
        }

        .footer-link {
            color: #ccc;
            text-decoration: none;
            transition: 0.3s;
            display: block;
            margin-bottom: 10px;
        }

        .footer-link:hover {
            color: var(--accent);
            transform: translateX(5px);
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
            <h1 class="fw-bold">Contact Us</h1>
            <p>Information about our website's liability and data accuracy.</p>
        </div>
    </div>
    <section class="py-5">
        <div class="container mt-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fa fa-phone-alt"></i></div>
                        <h5>Call Us</h5>
                        <p class="text-muted">
                            +91 {!! nl2br(str_replace(',', "\n+91 ", $settings->phone)) !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fa fa-envelope"></i></div>
                        <h5>Email Us</h5>
                        <p class="text-muted">{{ $settings->email }}<br>support@ngodemo.org</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fa fa-map-marker-alt"></i></div>
                        <h5>Visit Office</h5>
                        <p class="text-muted">Aliganj, Lucknow<br>Uttar Pradesh - 201416</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="p-4 bg-white rounded-4 shadow-sm">
                        <h3 class="fw-bold mb-4">Send Us a Message</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('home.contact_submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Your Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email Address">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Phone Number">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="subject" value="{{ old('subject') }}"
                                        class="form-control @error('subject') is-invalid @enderror" placeholder="Subject">
                                    @error('subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Your Message">{{ old('message') }}</textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-danger w-100 py-3 fw-bold rounded-pill">
                                        SEND MESSAGE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="map-container h-100">
                        <iframe src="{{ $settings->map_location }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
