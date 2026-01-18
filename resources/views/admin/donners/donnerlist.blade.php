@extends('admin.masters.layouts.app')

@section('content')
    <style>
        .filter-card {

            background: #ffffff;
            border: 1px solid #eef0f3;
        }

        .filter-card .form-label {
            font-size: 13px;
            color: #555;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            border-radius: 8px;
            font-size: 14px;
        }

        .filter-card .btn {
            border-radius: 8px;
            font-size: 14px;
        }

        .table {
            font-size: 14px;
        }

        .table thead th {
            background-color: #f8f9fc;
            font-weight: 600;
            color: #4e73df;
            text-transform: uppercase;
            font-size: 12px;
        }

        .table tbody tr:hover {
            background-color: #f9fafc;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 20px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            color: #4e73df;
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #e3e6f0;
            font-size: 14px;
        }

        .pagination .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
            color: #fff;
        }

        .pagination .page-link:hover {
            background-color: #f1f3f8;
        }

        .record-info {
            font-size: 13px;
            color: #6c757d;
        }

        .export-btns .btn {
            border-radius: 8px;
            font-size: 13px;
            padding: 6px 14px;
        }
    </style>
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800 fw-bold">Donors List</h1>
            <div>
                <a href="{{ route('admin.donors.export.csv') }}" class="btn btn-sm btn-dark">Export CSV</a>
                <a href="{{ route('admin.donors.export.pdf') }}" class="btn btn-sm btn-dark">Export PDF</a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                All Donors
            </div>

            <form method="GET" class="mb-3 filter-card">
                <div class="card-body">
                    <div class="row align-items-end g-2">

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Search Donor</label>
                            <input type="text" name="search" class="form-control" placeholder="Name, Email or Phone"
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-dark w-100">
                            Search
                            </button>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('admin.donors.donnerlist') }}" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </div>
            </form>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Donor Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Donations (₹)</th>
                                <th>Total Transactions</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($donors as $key => $donor)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $donor->donor_name }}</td>
                                    <td>{{ $donor->donor_email }}</td>
                                    <td>{{ $donor->donor_phone }}</td>
                                    <td class="fw-bold text-success">
                                        ₹ {{ number_format($donor->total_donation, 2) }}
                                    </td>
                                    <td>{{ $donor->total_transactions }}</td>
                                    <td>
                                        <a href="{{ route('admin.donations.80g', $donor->donation_id) }}">
                                            80G Certificate
                                        </a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        No Donors Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="record-info">
                            Showing
                            <strong>{{ $donors->firstItem() }}</strong>
                            to
                            <strong>{{ $donors->lastItem() }}</strong>
                            of
                            <strong>{{ $donors->total() }}</strong>
                            donors
                        </div>

                        <div>
                            {{ $donors->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
