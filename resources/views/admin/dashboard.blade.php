@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800 fw-bold">System Overview</h1>
        <span class="text-muted small">Updated: {{ now()->format('d M, Y H:i') }}</span>
    </div>

    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3 me-3">
                        <i class="fas fa-hand-holding-heart fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Donations</small>
                        <h5 class="fw-bold mb-0">₹ {{ number_format($totalDonations, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-3 me-3">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Members</small>
                        <h5 class="fw-bold mb-0">{{ number_format($totalMembers) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 me-3">
                        <i class="fas fa-images fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Gallery Items</small>
                        <h5 class="fw-bold mb-0">{{ number_format($totalGallery) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3 me-3">
                        <i class="fas fa-calendar-alt fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Upcoming Events</small>
                        <h5 class="fw-bold mb-0">{{ number_format($totalEvents) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-primary">Donation Flow (Monthly)</h6>
                </div>
                <div class="card-body">
                    <div style="height: 320px;">
                        <canvas id="donationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-primary">Expense Distribution</h6>
                </div>
                <div class="card-body">
                    <div style="height: 320px;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Monthly Donation Line Chart
    const ctx1 = document.getElementById('donationChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($chartLabels), // Labels from DB
            datasets: [{
                label: 'Donations (₹)',
                data: @json($chartValues), // Values from DB
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#4e73df'
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. Expense Category Pie Chart
    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: @json($expenseLabels),
            datasets: [{
                data: @json($expenseValues),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
                borderWidth: 5,
                hoverOffset: 10
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            },
            cutout: '70%'
        }
    });
</script>
@endpush