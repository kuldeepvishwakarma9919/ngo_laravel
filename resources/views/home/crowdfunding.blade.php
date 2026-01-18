@extends('home.masters.layouts.app')
@section('title', 'Member Apply')
@push('styles')
    <style>
        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: -50px;
        }


        /* Report Cards */
        .campaign-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            margin-bottom: 30px;
            border: none;
        }

        .campaign-card:hover {
            transform: translateY(-10px);
        }

        .campaign-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
        }

        .campaign-content {
            padding: 25px;
        }

        .category-badge {
            background: rgba(0, 128, 0, 0.1);
            color: var(--ngo-green);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }

        /* Progress Bar */
        .progress {
            height: 10px;
            border-radius: 10px;
            background: #eee;
            margin: 20px 0 10px;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--ngo-green), #32cd32);
        }

        .stat-box {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .stat-val {
            font-weight: 700;
            color: var(--navy);
        }

        .btn-donate-now {
            background: var(--danger);
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-donate-now:hover {
            background: var(--navy);
            transform: scale(1.02);
        }
    </style>
@endpush
@section('content')
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">Crowdfunding</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>



    <div class="container " style="margin-top: 100px">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--navy);" style="margin-top: 100px">Help Us Make a Difference</h2>
            <p class="text-muted">Aapka ek chota sa yogdaan kisi ki zindagi badal sakta hai.</p>
        </div>


        <div class="row">
            @forelse($campaigns as $campaign)
                <div class="col-lg-4 col-md-6">
                    <div class="campaign-card">
                        <img src="{{ $campaign->image ? asset('storage/' . $campaign->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000' }}"
                            class="campaign-img" alt="{{ $campaign->title }}">

                        <div class="campaign-content">
                            <span class="category-badge">{{ $campaign->category ?? 'NGO Mission' }}</span>

                            <h5 class="fw-bold mt-3">{{ $campaign->title }}</h5>
                            <p class="small text-muted">
                                {{ Str::limit($campaign->description, 100) }}
                            </p>

                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $campaign->progress }}%"></div>
                            </div>

                            <div class="stat-box">
                                <div>
                                    <span class="stat-val">₹{{ number_format($campaign->raised_amount) }}</span>
                                    <br><small>Raised ({{ $campaign->progress }}%)</small>
                                </div>
                                <div class="text-end">
                                    <span class="stat-val">₹{{ number_format($campaign->target_amount) }}</span>
                                    <br><small>Goal</small>
                                </div>
                            </div>

                            <a class="btn-donate-now btn" href='{{ route('home.donates.form', $campaign->id) }}'>
                                DONATE NOW
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No active campaigns at the moment.</h4>
                </div>
            @endforelse
        </div>
    </div>
@endsection
