@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Crowdfunding Teams</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.crowdfunding-teams.create') }}" class="btn btn-dark btn-sm">
                    Add Team
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                Crowdfunding Teams
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
                            <a href="{{ route('admin.crowdfunding-teams.index') }}" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </div>
            </form>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Team Name</th>
                            <th>Campaign</th>
                            <th>Leader</th>
                            <th>Target (₹)</th>
                            <th>Raised (₹)</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($teams as $key => $team)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>{{ $team->campaign->title ?? '-' }}</td>
                                <td>{{ $team->leader->name ?? '-' }}</td>
                                <td>₹ {{ $team->target_amount }}</td>
                                <td class="text-success fw-bold">₹ {{ $team->raised_amount }}</td>
                                <td>
                                    <span class="badge bg-{{ $team->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($team->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.crowdfunding-teams.edit', $team->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('admin.crowdfunding-teams.destroy', $team->id) }}"
                                        method="POST" class="d-inline" onsubmit="return confirm('Delete team?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Teams Found</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing {{ $teams->firstItem() }}–{{ $teams->lastItem() }} of {{ $teams->total() }} records
                    </div>

                    <div>
                        {{ $teams->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
