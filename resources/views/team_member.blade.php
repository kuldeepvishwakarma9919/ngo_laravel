@extends('home.masters.layouts.app')

@section('title', 'Our Team')

@push('styles')
    <style>
       
        .btn-apply {
            margin-top: 15px; 
            background: var(--ngo-green);
            color: white;
            font-weight: 700;
            padding: 10px 40px;
            border-radius: 50px;
            border: none;
            transition: 0.4s;
        }

        .btn-apply:hover {
            background: var(--primary);
            transform: translateY(-3px);
            color: white; 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .member-card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .member-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .member-img-box {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .member-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-info {
            padding: 20px;
            text-align: center;
        }

        .occupation-badge {
            font-size: 0.8rem;
            background: rgba(204, 0, 0, 0.1);
            color: #cc0000;
            padding: 4px 12px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .id-badge {
            font-size: 0.75rem;
            color: #666;
            display: block;
            margin-top: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="apply-header " style="padding: 100px 0; ">
        <div class="container">
            <h1 class="fw-bold">Team Member</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                @forelse($members as $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up">
                        <div class="card member-card">
                            <div class="member-img-box">
                                @if ($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->father_name }}">
                                @else
                                    <img src="https://via.placeholder.com/300x400?text=No+Photo" alt="Default">
                                @endif
                            </div>
                            <div class="member-info">
                                <span class="occupation-badge">{{ $member->occupation ?? 'Team Member' }}</span>
                                <h5 class="fw-bold mb-0 text-dark">
                                    Name: {{ $member->user->name ?? ($member->name ?? 'N/A') }}
                                </h5>

                                <p class="text-muted small mb-2">Qualification: {{ $member->qualification }}</p>

                                <div class="border-top pt-2">
                                    <a class="btn btn-apply " href="">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h3>No team members found.</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
