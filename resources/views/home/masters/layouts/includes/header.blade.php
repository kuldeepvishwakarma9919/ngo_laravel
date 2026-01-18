<div class="ticker-bar">
    <div class="container-fluid d-flex align-items-center">
        <div class="ticker-label">LATEST</div>
        <marquee behavior="scroll" direction="left" class="flex-grow-1">
            KDS सेवा समिति की बैठक सम्पन्न • नए सदस्य आईडी कार्ड डाउनलोड करें • वृक्षारोपण कार्यक्रम 2026 • मानवता की
            सेवा ही सर्वोपरि है
        </marquee>
    </div>
</div>

<div class="header-main">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h1 class="ngo-title"><img src="{{ $settings->logo }}" alt="" style="width: 80px;  height: 80px">
            </h1>
        </div>
        <div class="d-none d-md-flex gap-3 align-items-center">
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">Language</button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">
                            English
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('lang.switch', 'hi') }}">
                            हिंदी
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('home.donates') }}" class="btn btn-danger rounded-pill fw-bold">Donate</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand text-white d-lg-none fw-bold" href="{{ route('home.index') }}">MENU</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#kdsNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="kdsNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">
                          <i class="fa fa-home"></i> @lang('messages.home')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.member_apply') }}">Member Apply</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">ID Card</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('home.download_card') }}">Download Card</a></li>
                        <li><a class="dropdown-item" href="{{ route('home.verifications') }}">Verification</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{ route('home.about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.crowdfunding') }}">Crowdfunding</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.donates') }}">Donate</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.gallery') }}">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.audit_report') }}">Audit Report</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Important Link</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('upcomming.event') }}">Upcomming Event</a></li>
                        <li><a class="dropdown-item" href="{{ route('home.our_solution') }}">Our Solutions</a></li>
                        <li><a class="dropdown-item" href="{{ route('home.your_problem') }}">Your Problems</a></li>
                        <li><a class="dropdown-item" href="{{ route('home.our_project') }}">Our Projects</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Login</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('admin_login') }}">Admin Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('members.login') }}">Member Login</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.contact') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>
