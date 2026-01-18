@extends('home.masters.layouts.app')

@section('title', $event->title)

@section('content')
<style>
    .event-main-card { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    .event-img-top { width: 100%; height: 380px; object-fit: cover; }
    
    .registration-box { 
        background: #ffffff; 
        border-radius: 12px; 
        border: 2px solid #e9ecef; 
        transition: 0.3s;
    }
    .registration-box:hover { border-color: #198754; }

    .form-label { font-weight: 600; color: #444; font-size: 0.9rem; margin-bottom: 5px; }
    .form-control { 
        border-radius: 8px; 
        padding: 10px 15px; 
        border: 1px solid #ced4da;
    }
    .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1); border-color: #198754; }
    
    .side-event-card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .list-group-item { border: none; border-bottom: 1px solid #eee; padding: 15px 10px; }
    .list-group-item:last-child { border-bottom: none; }
</style>

<div class="container py-5">
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card event-main-card">
                <img src="{{ asset('uploads/events/' . $event->image) }}" class="event-img-top" alt="{{ $event->title }}">
                
                <div class="card-body p-4">
                    <h2 class="fw-bold mb-3">{{ $event->title }}</h2>
                    
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="text-muted"><i class="bi bi-calendar-check me-1 text-success"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}</span>
                        <span class="text-muted"><i class="bi bi-geo-alt me-1 text-success"></i> {{ $event->location }}</span>
                    </div>

                    <div class="description mb-4 text-secondary leading-relaxed">
                        {{ $event->description }}
                    </div>

                    <hr class="my-4">

                    <button class="btn btn-success btn-lg px-5 fw-bold shadow-sm" onclick="toggleForm()" id="regBtn">
                        Register Now
                    </button>

                    <div id="registrationForm" class="d-none mt-4">
                        <div class="registration-box p-4">
                            <h4 class="fw-bold mb-4 text-dark text-center">Event Registration</h4>
                            
                            <form method="POST" action="{{ route('event.register.store') }}">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" class="form-control" placeholder="Phone number" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="email@example.com">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Your city">
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="form-label">Total Participants</label>
                                        <input type="number" name="participants" class="form-control" value="1" min="1">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark btn-lg px-5">Submit Registration</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card side-event-card p-3">
                <h5 class="fw-bold mb-3 px-2">Upcoming Events</h5>
                <div class="list-group list-group-flush">
                    @foreach ($sideEvents as $side)
                        <a href="{{ route('event.detail', $side->id) }}" class="list-group-item list-group-item-action">
                            <h6 class="mb-1 fw-bold text-dark">{{ $side->title }}</h6>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($side->event_date)->format('d M Y') }}</small>
                        </a>
                    @endforeach
                </div>
                <div class="mt-3 text-center">
                    <a href="#" class="btn btn-sm btn-outline-success w-100 py-2">View All Events</a>
                </div>
            </div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    function toggleForm() {
        const form = document.getElementById('registrationForm');
        const btn = document.getElementById('regBtn');
        
        if (form.classList.contains('d-none')) {
            form.classList.remove('d-none');
            btn.innerText = "Close Form";
            btn.classList.replace('btn-success', 'btn-outline-danger');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            form.classList.add('d-none');
            btn.innerText = "Register Now";
            btn.classList.replace('btn-outline-danger', 'btn-success');
        }
    }
</script>
@endsection