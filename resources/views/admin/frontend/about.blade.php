@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 text-gray-800 fw-bold">{{ $about ? 'Update' : 'Create' }} About Us</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.about.store_or_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $about->id ?? '' }}">

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $about->title ?? '') }}">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label fw-bold">Short Description</label>
                        <textarea name="short_description" rows="2" class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $about->short_description ?? '') }}</textarea>
                        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label fw-bold">Full Description</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $about->description ?? '') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-bold">Our Vision</label>
                        <textarea name="vision" rows="3" class="form-control">{{ old('vision', $about->vision ?? '') }}</textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-bold">Our Mission</label>
                        <textarea name="mission" rows="3" class="form-control">{{ old('mission', $about->mission ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label fw-bold">History</label>
                        <textarea name="history" rows="3" class="form-control">{{ old('history', $about->history ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label fw-bold">Years of Experience</label>
                        <input type="number" name="years_of_experience" class="form-control" value="{{ old('years_of_experience', $about->years_of_experience ?? '') }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label fw-bold">Total Volunteers</label>
                        <input type="number" name="total_volunteers" class="form-control" value="{{ old('total_volunteers', $about->total_volunteers ?? '') }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label fw-bold">Total Beneficiaries</label>
                        <input type="number" name="total_beneficiaries" class="form-control" value="{{ old('total_beneficiaries', $about->total_beneficiaries ?? '') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-bold">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        @if(isset($about->banner_image))
                            <img src="{{ asset($about->banner_image) }}" width="100" class="mt-2 rounded">
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-bold">About Image</label>
                        <input type="file" name="about_image" class="form-control">
                        @if(isset($about->about_image))
                            <img src="{{ asset($about->about_image) }}" width="100" class="mt-2 rounded">
                        @endif
                    </div>

                    <hr>
                    <h5 class="fw-bold text-primary">SEO Section</h5>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $about->meta_title ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ (old('status', $about->status ?? '') == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ (old('status', $about->status ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Meta Description</label>
                        <textarea name="meta_description" class="form-control">{{ old('meta_description', $about->meta_description ?? '') }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn px-5 btn_submit">
                        <i class="fas fa-save"></i> {{ $about ? 'Update Settings' : 'Save Settings' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection