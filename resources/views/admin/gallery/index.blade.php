@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Gallery</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>


                @if (auth()->user()->hasPermission('gallery_add'))
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-dark btn-sm">
                        Add Gallery
                    </a>
                @endif
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
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($galleries as $key => $gallery)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <!-- Preview -->
                                <td>
                                    @if ($gallery->type === 'image')
                                        <img src="{{ asset($gallery->file_path) }}" width="70" height="50"
                                            class="rounded">
                                    @else
                                        <video width="80" height="50" controls>
                                            <source src="{{ asset($gallery->file_path) }}">
                                        </video>
                                    @endif
                                </td>

                                <td>{{ $gallery->title }}</td>
                                <td class="text-capitalize">{{ $gallery->type }}</td>
                                <td>{{ Str::limit($gallery->description, 30) }}</td>

                                <!-- Status -->
                                <td>
                                    @if ($gallery->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>{{ $gallery->created_at->format('d M Y') }}</td>

                                <!-- Action -->
                                <td>
                                    <a href="" class="btn btn-sm btn-dark">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this gallery?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Trash
                                        </button>
                                    </form>


                                    <!-- Status Toggle -->
                                    <a href="{{ route('admin.gallery.status', $gallery->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Status
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No Gallery Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="record-info">
                        Showing
                        <strong>{{ $galleries->firstItem() }}</strong>
                        to
                        <strong>{{ $galleries->lastItem() }}</strong>
                        of
                        <strong>{{ $galleries->total() }}</strong>
                        campaigns
                    </div>

                    <div>
                        {{ $galleries->links('pagination::bootstrap-5') }}
                    </div>
                </div>


            </div>
        </div>


    </div>
@endsection
