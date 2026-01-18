@extends('admin.masters.layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800 fw-bold">Event Registration</h1>
            <div class="export-btns">
                <a href="{{ route('admin.registrations.export') }}" class="btn btn-dark btn-sm">Export CSV</a>
                <a href="" class="btn btn-dark btn-sm">Export PDF</a>
                <a href="{{ route('admin.events.create') }}" class="btn btn-dark btn-sm">Add Event</a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Event Registration</div>

            <!-- Filters -->
            <form method="GET" class="mb-3 filter-card">
                <div class="card-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Search Event Registration</label>
                            <input type="text" name="search" class="form-control" placeholder="Event Title"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Payment Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-between align-items-center">
                            <button class="btn btn-dark w-100 me-2">Apply Filters</button>
                            <a href="{{ route('admin.events.registrations') }}"
                                class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Registration Table -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Event Status</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Participants</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $key => $reg)
                                <tr>
                                    <td>{{ $registrations->firstItem() + $key }}</td>
                                    <td>{{ $reg->event_title }}</td>
                                    <td>
                                        @if ($reg->event_status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ $reg->name }}</td>
                                    <td>{{ $reg->mobile }}</td>
                                    <td>{{ $reg->email }}</td>
                                    <td>{{ $reg->city }}</td>
                                    <td>{{ $reg->participants }}</td>
                                    <td>
                                        @if ($reg->status == 'approved')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($reg->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $registrations->firstItem() }}–{{ $registrations->lastItem() }} of
                            {{ $registrations->total() }} records
                        </div>
                        <div>
                            {{ $registrations->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
