@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Audit Reports</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.audit-reports.create') }}" class="btn btn-dark btn-sm">
                    Add Audit Report
                </a>
            </div>
        </div>


        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                Campaigns
            </div>

            <form method="GET" class=" mb-3 filter-card">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- 🔍 Search -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Search Campaign</label>
                            <input type="text" name="search" class="form-control" placeholder="Campaign title"
                                value="{{ request('search') }}">
                        </div>

                        <!-- 📅 From Date -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>

                        <!-- 📅 To Date -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>

                        <!-- 📌 Status -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-3 d-flex justify-content-between alugn-items-center">
                            <button class="btn btn-dark w-100 me-2">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.audit-reports.index') }}" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </div>
            </form>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>FY</th>
                            <th>Type</th>
                            <th>CA</th>
                            <th>Public</th>
                            <th>Downloads</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->title }}</td>
                                <td>{{ $r->financial_year }}</td>
                                <td>{{ $r->report_type }}</td>
                                <td>{{ $r->ca_name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $r->is_public ? 'success' : 'secondary' }}">
                                        {{ $r->is_public ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>{{ $r->download_count }}</td>
                                <td>
                                    <a href="{{ route('admin.audit-reports.show', $r->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.audit-reports.download', $r->id) }}"
                                        class="btn btn-sm btn-success">PDF</a>
                                    <a href="{{ route('admin.audit-reports.edit', $r->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3 record-info">
                    <div class="record-count">
                        Showing
                        <strong>{{ $reports->firstItem() }}</strong> –
                        <strong>{{ $reports->lastItem() }}</strong>
                        of
                        <strong>{{ $reports->total() }}</strong> records
                    </div>

                    <div>
                        {{ $reports->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
