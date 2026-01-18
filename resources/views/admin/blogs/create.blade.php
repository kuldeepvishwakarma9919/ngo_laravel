@extends('admin.masters.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 text-gray-800 fw-bold">Create Blog</h1>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-dark">Back</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Author Name</label>
                            <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}">
                        </div>


                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Publish Date</label>
                            <input type="date" name="published_at" class="form-control">
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Description</label>
                        <textarea name="short_description" rows="2" class="form-control">{{ old('short_description') }}</textarea>
                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Content</label>
                        <textarea name="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Type <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-select">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Image / Video URL <span class="text-danger">*</span></label>
                            <input type="file" name="file" id="fileInput" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Featured -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Featured</label>
                            <select name="is_featured" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control">
                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn px-4 btn_submit">
                            <i class="fas fa-save"></i> Save Blog
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('type').addEventListener('change', function() {
            if (this.value === 'video') {
                document.getElementById('fileInput').type = 'text';
                document.getElementById('fileInput').placeholder = 'Enter Video URL';
            } else {
                document.getElementById('fileInput').type = 'file';
            }
        });
    </script>
@endpush
