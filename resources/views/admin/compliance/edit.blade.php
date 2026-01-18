@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h4 fw-bold mb-4">Edit Compliance Document</h1>

        <form action="{{ route('admin.compliance.update', $doc->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $doc->title }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Type</label>
                    <select name="doc_type" class="form-control" required>
                        @foreach (['12A', '80G', 'FCRA', 'Trust Deed', 'Registration', 'Annual Return', 'Other'] as $type)
                            <option value="{{ $type }}" {{ $doc->doc_type == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Number</label>
                    <input type="text" name="doc_number" value="{{ $doc->doc_number }}" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Issue Date</label>
                    <input type="date" name="issue_date" value="{{ $doc->issue_date }}" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" value="{{ $doc->expiry_date }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Issuing Authority</label>
                    <input type="text" name="authority" value="{{ $doc->authority }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Replace Document</label>
                    <input type="file" name="file" class="form-control">
                    <small>
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">View Current File</a>
                    </small>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $doc->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $doc->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="pending" {{ $doc->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3 d-flex align-items-center">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_public" value="1"
                            {{ $doc->is_public ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Public Document
                        </label>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks" rows="3" class="form-control">{{ $doc->remarks }}</textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                Update Document
            </button>
            <a href="{{ route('admin.compliance.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>
    </div>
@endsection
