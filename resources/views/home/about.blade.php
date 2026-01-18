@extends('home.masters.layouts.app')
@section('title', 'About')
@push('styles')
    <style>
        /* About Page Specific Hero */
        .about-hero {
            background: linear-gradient(rgba(26, 42, 108, 0.8), rgba(0, 128, 0, 0.7)), url('https://images.unsplash.com/photo-1524069290683-0457abfe42c3?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            clip-path: ellipse(150% 100% at 50% 0%);
        }

        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-weight: 800;
            color: var(--primary);
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
        }

        .text-center .section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }



        /* FOOTER */
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

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .contact-item i {
            color: var(--accent);
            margin-right: 12px;
            margin-top: 4px;
        }

        .sticky-donate {
            position: fixed;
            left: -130px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 999;
            transition: 0.3s;
        }

        .sticky-donate:hover {
            left: 0;
        }

        .sticky-donate a {
            background: var(--danger);
            color: white;
            padding: 12px 20px;
            border-radius: 0 50px 50px 0;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
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
    </section>
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">About Us</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">

                    <h2 class="section-title">{{ $aboutData->title ?? 'Title not found' }}</h2>
                    <p class="mt-4">{{ $aboutData->description ?? 'Title not found' }}</p>
                    <p>Since our inception, we have been working tirelessly to ensure that basic rights like education,
                        healthcare, and clean water are accessible to everyone, regardless of their socio-economic status.
                    </p>
                    <div class="bg-light p-4 rounded border-start border-4 border-success mt-4">
                        <i class="fa fa-quote-left text-success mb-3"></i>
                        <p class="fst-italic">"{{ $aboutData->history ?? 'History not found' }}."</p>
                    </div>
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left">
                    <img src="{{ asset('storage/' . $aboutData->about_image) }}" class="img-fluid rounded shadow-lg"
                        alt="Our Team">
                </div>
            </div>
        </div>
    </section>
@endsection
