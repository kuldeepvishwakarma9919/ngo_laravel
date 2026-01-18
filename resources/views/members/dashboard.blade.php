@extends('members.masters.app')

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
                        <h5 class="fw-bold mb-0">₹ 33</h5>
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
                        <h5 class="fw-bold mb-0">33</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
</div>
@endsection
