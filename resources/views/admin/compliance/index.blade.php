@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">




        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Documents</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('admin.compliance.create') }}" class="btn btn-dark btn-sm">
                    Add Document
                </a>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                Document
            </div>

            <form method="GET" class=" mb-3 filter-card">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- 🔍 Search -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Search Document</label>
                            <input type="text" name="search" class="form-control" placeholder="Document title"
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
                            <a href="{{ route('admin.compliance.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Type</th>
                            <th>Doc No</th>
                            <th>Status</th>
                            <th>Expiry</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($docs as $key => $doc)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $doc->title }}</td>
                                <td>{{ $doc->doc_type }}</td>
                                <td>{{ $doc->doc_number ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $doc->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($doc->status) }}
                                    </span>
                                </td>
                                <td>{{ $doc->expiry_date ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-info">View</a>

                                    <a href="{{ route('admin.compliance.edit', $doc->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing
                        <strong>{{ $docs->firstItem() }}</strong> –
                        <strong>{{ $docs->lastItem() }}</strong>
                        of
                        <strong>{{ $docs->total() }}</strong> documents
                    </div>

                    <div>
                        {{ $docs->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
