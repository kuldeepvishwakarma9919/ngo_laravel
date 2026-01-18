@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Goal Tracking</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.goals.create') }}" class="btn btn-dark btn-sm">+ Add Goal</a>
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
                            <a href="{{ route('admin.goals.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Goal</th>
                            <th>Campaign</th>
                            <th>Target</th>
                            <th>Achieved</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($goals as $key => $goal)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $goal->title }}</td>
                                <td>{{ $goal->campaign->title ?? '-' }}</td>
                                <td>₹ {{ $goal->target_amount }}</td>
                                <td class="text-success">₹ {{ $goal->achieved_amount }}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ $goal->progressPercentage() }}%">
                                            {{ $goal->progressPercentage() }}%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $goal->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($goal->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.goals.edit', $goal->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.goals.destroy', $goal->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Goals Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing {{ $goals->firstItem() }}–{{ $goals->lastItem() }} of {{ $goals->total() }} records
                    </div>

                    <div>
                        {{ $goals->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
