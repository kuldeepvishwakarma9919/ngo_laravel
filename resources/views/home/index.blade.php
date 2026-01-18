@extends('home.masters.layouts.app')
@section('title', 'NGO Home Page')
@push('styles')
    <style>
        :root {
            --ngo-dark-green: #147a00;
            --ngo-light-green: #e9f5e9;
        }

        .action-btn {
            background: white;
            border: 2px solid var(--ngo-dark-green);
            color: var(--ngo-dark-green);
            border-radius: 12px;
            padding: 20px 10px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s all ease;
            text-decoration: none;
        }

        .action-btn i {
            font-size: 28px;
        }

        .action-btn:hover {
            background: var(--ngo-dark-green);
            color: white;
            transform: translateY(-5px);
        }

        .action-btn.highlight {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .action-btn.highlight:hover {
            background: #b02a37;
            border-color: #b02a37;
        }

        .action-bar-section {
            border-bottom: 1px solid #eee;
            position: relative;
            z-index: 10;
            margin-top: -30px;
        }
    </style>
@endpush
@section('content')
    <section class="hero-banner p-0">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active"
                    style=" url('https://amanjansewasamiti.in/images/banner1.jpg'); background-size: cover; height: 500px;">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="text-white" data-aos="fade-right">
                            <h1 class="display-4 fw-bold mb-3">Your Support <span class="text-warning">Changes</span> Their
                                Future.</h1>
                            <p class="fs-5 mb-4 opacity-75">India's most transparent NGO platform for social welfare.</p>
                            <div class="d-flex gap-3">
                                <a href="{{ route('home.member_apply') }}"
                                    class="btn btn-warning btn-lg px-4 rounded-pill fw-bold">JOIN US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="action-bar-section py-4" style="background-color: #f8fdf9;">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-2" data-aos="fade-up">
                    <a href="{{ route('home.member_apply') }}" class="btn action-btn w-100 shadow-sm">
                        <i class="fa fa-user-plus d-block mb-2"></i>
                        <span>Member Apply</span>
                    </a>
                </div>
                <div class="col-6 col-md-2" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('upcomming.event') }}" class="btn action-btn w-100 shadow-sm">
                        <i class="fa fa-calendar-alt d-block mb-2"></i>
                        <span>Upcoming Events</span>
                    </a>
                </div>
                <div class="col-6 col-md-2" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('home.team_member') }}" class="btn action-btn w-100 shadow-sm">
                        <i class="fa fa-users d-block mb-2"></i>
                        <span>Management Team</span>
                    </a>
                </div>
                <div class="col-6 col-md-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('home.donates') }}" class="btn action-btn w-100 shadow-sm highlight">
                        <i class="fa fa-hand-holding-heart d-block mb-2"></i>
                        <span>Donate Now</span>
                    </a>
                </div>
                <div class="col-6 col-md-2" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('home.crowdfunding') }}" class="btn action-btn w-100 shadow-sm">
                        <i class="fa fa-bullhorn d-block mb-2"></i>
                        <span>Crowdfunding</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="dynamic-card">
                    <div class="icon-badge"><i class="fa fa-id-card"></i></div>
                    <h5>Digital ID Cards</h5>
                    <p class="text-muted small">Instant QR-protected identity for volunteers.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="dynamic-card">
                    <div class="icon-badge"><i class="fa fa-file-invoice"></i></div>
                    <h5>80G Receipts</h5>
                    <p class="text-muted small">Get tax exemption receipts for contributions.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="dynamic-card">
                    <div class="icon-badge"><i class="fa fa-bullseye"></i></div>
                    <h5>Latest Updates</h5>
                    <p class="text-muted small">Follow our recent activities and events.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8" data-aos="fade-up">
                    <h3 class="mb-4 border-bottom pb-2 text-success fw-bold">Latest Activity</h3>

                    @forelse($events as $event)
                        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="{{ asset('uploads/events/' . $event->image) }}" class="img-fluid h-100 w-100"
                                        alt="{{ $event->title }}" style="object-fit: cover; min-height: 200px;">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                <i class="fa fa-calendar-alt me-1"></i>
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                            </span>
                                            <small class="text-muted"><i class="fa fa-map-marker-alt"></i>
                                                {{ $event->location }}</small>
                                        </div>
                                        <h5 class="fw-bold">{{ $event->title }}</h5>
                                        <p class="text-muted small">
                                            {{ Str::limit($event->description, 150) }}
                                        </p>
                                        <a href="{{ route('event.detail', $event->id) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5 bg-white rounded-4 shadow-sm">
                            <p class="text-muted">No recent activities found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="col-lg-4" data-aos="fade-left">
                    <h3 class="mb-4 border-bottom pb-2 text-success fw-bold">News Updates</h3>
                    <div class="bg-white p-3 rounded-4 shadow-sm" style="height: 450px; overflow-y: auto;">
                        <marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                            <ul class="list-unstyled">
                                @foreach ($events as $news)
                                    <li class="mb-3 border-bottom pb-2">
                                        <a href="#" class="text-decoration-none text-dark">
                                            <i class="fa fa-star text-warning me-2"></i>
                                            <strong>NEW:</strong> {{ $news->title }}
                                            <div class="small text-muted ps-4">Date: {{ $news->event_date }}</div>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="mb-3 border-bottom pb-2 text-primary">
                                    <i class="fa fa-user-plus me-2"></i> Naye sadasya judne ke liye form bharein.
                                </li>
                            </ul>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container text-center mb-5">
            <h2 class="section-title d-inline-block">{{ $aboutData->title ?? 'About Our Mission' }}</h2>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5" data-aos="fade-right">
                    <img src="{{ asset('storage/' . ($aboutData->about_image ?? 'default.jpg')) }}"
                        class="img-fluid rounded-4 shadow-lg border" alt="Mission">
                </div>
                <div class="col-lg-7 ps-lg-5" data-aos="fade-left">
                    <p class="text-muted fs-5 lead">
                        {{ $aboutData->description ?? 'We are dedicated to social welfare...' }}</p>
                    <div class="row g-3 mt-4">
                        <div class="col-6"><i class="fa fa-check-circle text-success me-2"></i> Quality Education</div>
                        <div class="col-6"><i class="fa fa-check-circle text-success me-2"></i> Free Medical</div>
                        <div class="col-6"><i class="fa fa-check-circle text-success me-2"></i> Woman Empowerment</div>
                        <div class="col-6"><i class="fa fa-check-circle text-success me-2"></i> Clean Environment</div>
                    </div>
                    <a href="{{ route('home.about') }}" class="btn rounded-pill mt-4 px-4 py-2"
                        style="background-color: #008000; color: #fff;">Read Full Message</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding text-white" style="background-color: #008000;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 text-center" data-aos="zoom-in">
                    <img src="{{ asset('men_image.jpg') }}"
                        class="rounded-circle border border-4 border-white shadow mb-3" width="200" height="200"
                        style="object-fit: cover;">
                    <h5 class="mb-0">Narendra Singh</h5>
                    <p class="small opacity-75">Secretary Message</p>
                </div>
                <div class="col-lg-9" data-aos="fade-left">
                    <h3 class="fw-bold mb-4">A Message from our Leader</h3>
                    <p class="fst-italic fs-5">"Hamara lakshya har zarooratmand tak pahunchkar unke jeevan mein sakaratmak
                        badlav lana hai. Aapka thoda sa sahyog kisi ka bhavishya badal sakta hai."</p>
                    <hr class="bg-white">
                    <p class="mb-0">Join us in our journey of serving humanity.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="section-title mb-5">Our Core Objectives</h2>
            <div class="row g-4">
                <div class="col-md-3" data-aos="flip-left">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <img src="https://cdn-icons-png.flaticon.com/512/3063/3063822.png" width="60" class="mb-3">
                        <h6>Environment</h6>
                    </div>
                </div>
                <div class="col-md-3" data-aos="flip-left" data-aos-delay="100">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" width="60" class="mb-3">
                        <h6>Social Welfare</h6>
                    </div>
                </div>
                <div class="col-md-3" data-aos="flip-left" data-aos-delay="200">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" width="60" class="mb-3">
                        <h6>Education</h6>
                    </div>
                </div>
                <div class="col-md-3" data-aos="flip-left" data-aos-delay="300">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <img src="https://cdn-icons-png.flaticon.com/512/3126/3126731.png" width="60" class="mb-3">
                        <h6>Human Rights</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h2 class="section-title mb-0">Event Gallery</h2>
                <a href="{{ route('home.gallery') }}" class="btn btn-outline-success rounded-pill">View All</a>
            </div>
            <div class="row g-3">
                @foreach ($galleries as $gallery)
                    <div class="col-md-4 " data-aos="zoom-in">
                        <img src="{{ asset($gallery->file_path) }}" class="img-fluid rounded-4 gallery-img border"
                            style="height: 250px; width: 100%; object-fit: cover;">
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="newsletter-section rounded-5 p-5 bg-warning" data-aos="flip-up">
            <div class="row align-items-center text-dark">
                <div class="col-md-7 text-center text-md-start">
                    <h3 class="fw-bold">Subscribe for Updates</h3>
                    <p class="mb-0">Stay connected with our latest impact stories and events.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="input-group">
                        <input type="email" class="form-control rounded-pill-start border-0 px-4"
                            placeholder="Enter Email Address">
                        <button class="btn btn-dark rounded-pill-end fw-bold px-4">JOIN</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
