@extends('home.masters.layouts.app')

@section('title', 'Our Projects - NGO Impact')

@section('content')
    <style>
        .project-header {
            background-color: #f0fdf4; /* Very light green */
            padding: 60px 0;
            border-bottom: 2px solid #e9ecef;
        }

        .project-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.3s ease;
            background: #fff;
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }

        .project-img-wrapper {
            position: relative;
            height: 230px;
        }

        .project-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-ongoing { background: #ffc107; color: #000; }
        .status-completed { background: #198754; color: #fff; }

        .progress {
            height: 8px;
            border-radius: 10px;
            margin: 15px 0;
        }

        .project-meta {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>

    <div class="project-header text-center">
        <div class="container">
            <h1 class="fw-bold">Our On-Going & Past Projects</h1>
            <p class="text-muted">Ek ek kadam badlav ki ore. Humare dwara chalaye gaye pramukh abhiyaan.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="card project-card">
                    <div class="project-img-wrapper">
                        <span class="status-badge status-ongoing">Ongoing</span>
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80" alt="Project Image">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold">Project Vidya: Digital School</h5>
                        <p class="text-secondary small">Gramin kshetron mein computer lab setup karke bacho ko modern technology se jodna.</p>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small>Fund Raised</small>
                                <small class="fw-bold">75%</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="project-meta">
                            <span><i class="bi bi-geo-alt me-1"></i> Bihar, India</span>
                            <span><i class="bi bi-people me-1"></i> 500+ Students</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card project-card">
                    <div class="project-img-wrapper">
                        <span class="status-badge status-completed">Completed</span>
                        <img src="https://images.unsplash.com/photo-1541252260730-0412e8e2108e?auto=format&fit=crop&w=600&q=80" alt="Project Image">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold">Nirmal Jal Abhiyaan</h5>
                        <p class="text-secondary small">10 se zyada gaon mein solar water pumps aur filters install karke saaf pani pahunchaya gaya.</p>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small>Status</small>
                                <small class="fw-bold text-success">Successful</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="project-meta">
                            <span><i class="bi bi-geo-alt me-1"></i> Rajasthan</span>
                            <span><i class="bi bi-house-heart me-1"></i> 1200+ Families</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card project-card">
                    <div class="project-img-wrapper">
                        <span class="status-badge status-ongoing">Ongoing</span>
                        <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=600&q=80" alt="Project Image">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold">Mobile Clinic Initiative</h5>
                        <p class="text-secondary small">Aisi jagahon par medical van pahunchana jahan koi hospital nahi hai. Free checkup aur dawai.</p>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small>Fund Raised</small>
                                <small class="fw-bold">40%</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"></div>
                            </div>
                        </div>

                        <div class="project-meta">
                            <span><i class="bi bi-geo-alt me-1"></i> UP East</span>
                            <span><i class="bi bi-hospital me-1"></i> Weekly Camps</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <button class="btn btn-outline-success px-5 py-2 fw-bold">Load More Projects</button>
        </div>
    </div>

    <div class="container-fluid bg-dark text-white py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h2 class="fw-bold">15+</h2>
                    <p class="text-muted">Active Projects</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold">100+</h2>
                    <p class="text-muted">Locations Covered</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold">₹50L+</h2>
                    <p class="text-muted">Total Fund Utilized</p>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection