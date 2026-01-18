@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 text-gray-800 fw-bold">Edit Blog</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-dark">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.blogs.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title"
                        value="{{ old('title',$blog->title) }}"
                        class="form-control @error('title') is-invalid @enderror">
                </div>

                <!-- Author -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Author Name</label>
                    <input type="text" name="author_name"
                        value="{{ old('author_name',$blog->author_name) }}"
                        class="form-control">
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Short Description</label>
                    <textarea name="short_description" rows="2"
                        class="form-control">{{ old('short_description',$blog->short_description) }}</textarea>
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Content</label>
                    <textarea name="content" rows="5"
                        class="form-control">{{ old('content',$blog->content) }}</textarea>
                </div>

                <!-- Type -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" id="type" class="form-select">
                        <option value="image" {{ $blog->featured_image ? 'selected' : '' }}>Image</option>
                        <option value="video" {{ $blog->video_url ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <!-- File / Video -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Upload Image / Video URL</label>

                    @if($blog->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/blogs/'.$blog->featured_image) }}"
                                 width="120" class="rounded">
                        </div>
                    @endif

                    <input type="{{ $blog->video_url ? 'text' : 'file' }}"
                        name="file"
                        value="{{ $blog->video_url }}"
                        id="fileInput"
                        class="form-control">
                </div>

                <!-- Featured -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Featured</label>
                    <select name="is_featured" class="form-select">
                        <option value="0" {{ $blog->is_featured == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $blog->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- SEO -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Meta Title</label>
                        <input type="text" name="meta_title"
                            value="{{ $blog->meta_title }}"
                            class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Meta Keywords</label>
                        <input type="text" name="meta_keywords"
                            value="{{ $blog->meta_keywords }}"
                            class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Meta Description</label>
                        <input type="text" name="meta_description"
                            value="{{ $blog->meta_description }}"
                            class="form-control">
                    </div>
                </div>

                <!-- Publish Date -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Publish Date</label>
                    <input type="date" name="published_at"
                        value="{{ optional($blog->published_at)->format('Y-m-d') }}"
                        class="form-control">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> Update Blog
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
document.getElementById('type').addEventListener('change', function () {
    let input = document.getElementById('fileInput');
    if (this.value === 'video') {
        input.type = 'text';
        input.placeholder = 'Enter video URL';
    } else {
        input.type = 'file';
    }
});
</script>
@endpush
