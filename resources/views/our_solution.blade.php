@extends('home.masters.layouts.app')

@section('title', 'Our Solutions - Helping Hands NGO')

@section('content')
    <style>
        .solution-header {
            background: linear-gradient(rgba(25, 135, 84, 0.8), rgba(25, 135, 84, 0.9)), 
                        url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            margin-bottom: 50px;
        }

        .solution-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .solution-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .solution-icon-box {
            width: 70px;
            height: 70px;
            background: rgba(25, 135, 84, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .solution-icon-box i {
            font-size: 2rem;
            color: #198754;
        }

        .solution-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .impact-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #198754;
        }
    </style>

    <div class="solution-header text-center">
        <div class="container">
            <h1 class="fw-bold display-4">Our Solutions</h1>
            <p class="lead mx-auto" style="max-width: 700px;">
                Hum mushkilon ko sirf pehchante nahi, unka samadhan nikaalte hain. Discover how we are creating lasting impact in the society.
            </p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="card solution-card p-4">
                    <div class="solution-icon-box">
                        <i class="bi bi-book"></i>
                    </div>
                    <h4 class="fw-bold">Quality Education</h4>
                    <p class="text-secondary">Hum underprivileged bacho ko free coaching aur school supplies provide karte hain taaki har bacha padh sake.</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Free Digital Classes</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Library Access</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card solution-card p-4">
                    <div class="solution-icon-box">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h4 class="fw-bold">Healthcare Access</h4>
                    <p class="text-secondary">Rural areas mein medical camps aur free health checkups ke zariye hum swasthya sevaein pahunchate hain.</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Monthly Health Camps</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Medicine Distribution</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card solution-card p-4">
                    <div class="solution-icon-box">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="fw-bold">Skill Development</h4>
                    <p class="text-secondary">Youth aur women ko vocational training dekar hum unhein kaam dhoondhne aur atmanirbhar banne mein madad karte hain.</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Tailoring Classes</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Computer Literacy</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-light py-5">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-5">Our Impact So Far</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="impact-number">10K+</div>
                    <p class="text-muted fw-bold">Lives Impacted</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="impact-number">50+</div>
                    <p class="text-muted fw-bold">Villages Covered</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="impact-number">500+</div>
                    <p class="text-muted fw-bold">Volunteers</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="impact-number">100%</div>
                    <p class="text-muted fw-bold">Transparency</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 my-5 text-center">
        <div class="card bg-dark text-white p-5 border-0 rounded-4 shadow">
            <h2 class="fw-bold mb-3">Be Part of the Solution</h2>
            <p class="mb-4 opacity-75">Aapka ek chota sa yogdaan kisi ki zindagi badal sakta hai.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-success btn-lg px-4 fw-bold">Donate Now</a>
                <a href="#" class="btn btn-outline-light btn-lg px-4 fw-bold">Volunteer</a>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection