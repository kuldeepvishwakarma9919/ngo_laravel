@extends('admin.masters.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800 fw-bold">Event</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.events.create') }}" class="btn btn-dark btn-sm">
                    Add Event
                </a>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                Event List
            </div>
            <form method="GET" class=" mb-3 filter-card">
                <div class="card-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Search Campaign</label>
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
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Event Date</th>
                                <th>Location</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($events as $key => $event)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>
                                        @if ($event->image)
                                            <img src="{{ asset('uploads/events/' . $event->image) }}" width="60" class="rounded shadow-sm">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $event->status == 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.events.edit',$event->id ) }}" class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('admin.events.destroy',$event->id ) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this event?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        No Events Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $events->firstItem() }}–{{ $events->lastItem() }} of {{ $events->total() }}
                            records
                        </div>

                        <div>
                            {{ $events->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
