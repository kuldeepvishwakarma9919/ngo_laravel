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
    <section class="contact-hero">
        <div class="container" data-aos="zoom-in">
            <h1 class="display-4 fw-bold">Get In Touch</h1>
            <p class="fs-5 opacity-75">Have questions? We are here to help and answer any question you might have.</p>
        </div>
    </section>


    <section class="pb-5 mt-5">
        <div class="container">
            <div class="row g-4">

                @forelse($events as $event)
                    <div class="col-md-4">
                        <div class="card shadow h-100 border-0">
                            <img src="{{ asset('uploads/events/' . $event->image) }}" class="card-img-top"
                                alt="{{ $event->title }}">

                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>

                                <p class="text-muted mb-1">
                                    📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </p>

                                <p class="text-muted mb-2">
                                    📍 {{ $event->location }}
                                </p>

                                <p class="card-text">
                                    {{ Str::limit($event->description, 100) }}
                                </p>

                                <a href="{{ route('event.detail', $event->id) }}" class="btn btn-dark btn-sm mt-2">
                                    View Details
                                </a>
                            </div>



                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h4 class="text-muted">No upcoming events available</h4>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
