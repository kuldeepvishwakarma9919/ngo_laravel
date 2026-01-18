@extends('admin.masters.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Campaigns List</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.campaigns.create') }}" class="btn btn-dark btn-sm">
                    Add Campaign
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
                            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Target (₹)</th>
                            <th>Raised (₹)</th>
                            <th>Progress</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campaigns as $key => $campaign)
                            @php
                                $percent =
                                    $campaign->target_amount > 0
                                        ? ($campaign->raised_amount / $campaign->target_amount) * 100
                                        : 0;
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $campaign->title }}</td>
                                <td>₹ {{ number_format($campaign->target_amount) }}</td>
                                <td class="text-success fw-bold">
                                    ₹ {{ number_format($campaign->raised_amount) }}
                                </td>

                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width: {{ min(100, $percent) }}%">
                                            {{ number_format($percent, 1) }}%
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($campaign->start_date)->format('d M Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($campaign->end_date)->format('d M Y') }}
                                </td>

                                <td>
                                    @if ($campaign->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Closed</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.campaigns.edit', $campaign->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>

                                    @if ($campaign->status)
                                        <a href="{{ route('admin.campaigns.close', $campaign->id) }}"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Close this campaign?')">
                                            Close
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No Campaign Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="record-info">
                        Showing
                        <strong>{{ $campaigns->firstItem() }}</strong>
                        to
                        <strong>{{ $campaigns->lastItem() }}</strong>
                        of
                        <strong>{{ $campaigns->total() }}</strong>
                        campaigns
                    </div>

                    <div>
                        {{ $campaigns->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
