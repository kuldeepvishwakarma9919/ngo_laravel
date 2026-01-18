@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">



        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Blog List</h1>
            <div class="export-btns">
                <a href="" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                @if (auth()->user()->hasPermission('blog_add'))
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark btn-sm">
                    Add Blog
                </a>
                @endif
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Card -->
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
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    @if ($blog->featured_image)
                                        <img src="{{ asset('uploads/blogs/' . $blog->featured_image) }}" width="60"
                                            class="rounded">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td>{{ $blog->title }}</td>

                                <td>
                                    {{ $blog->blog_categories->name ?? '-' }}
                                </td>

                                <td>
                                    @if ($blog->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>{{ $blog->view_count ?? 0 }}</td>

                                <td>
                                     @if (auth()->user()->hasPermission('blog_edit'))
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                     @if (auth()->user()->hasPermission('blog_delete'))
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No blogs found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                 <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="record-info">
                        Showing
                        <strong>{{ $blogs->firstItem() }}</strong>
                        to
                        <strong>{{ $blogs->lastItem() }}</strong>
                        of
                        <strong>{{ $blogs->total() }}</strong>
                        campaigns
                    </div>

                    <div>
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
