@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Project Locations</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.project-locations.create') }}" class="btn btn-dark btn-sm">
                    Add Project
                </a>
            </div>
        </div>



        <div class="card shadow-sm">

            <div class="card-header bg-white fw-bold">
                Project Location
            </div>

            <form method="GET" class=" mb-3 filter-card">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- 🔍 Search -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Search project</label>
                            <input type="text" name="search" class="form-control" placeholder="Project Location"
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
                            <a href="{{ route('admin.project-locations.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Project</th>
                            <th>Campaign</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($locations as $key => $loc)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $loc->project_name }}</td>
                                <td>{{ $loc->campaign->title ?? '-' }}</td>
                                <td>{{ $loc->city }}</td>
                                <td>{{ $loc->state }}</td>
                                <td>
                                    <span class="badge bg-{{ $loc->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($loc->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.project-locations.edit', $loc->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>

                                    <form method="POST" action="{{ route('admin.project-locations.destroy', $loc->id) }}"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Locations Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing {{ $locations->firstItem() }}–{{ $locations->lastItem() }}
                        of {{ $locations->total() }} records
                    </div>

                    <div>
                        {{ $locations->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
