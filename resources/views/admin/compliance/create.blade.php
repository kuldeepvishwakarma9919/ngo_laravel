@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h4 fw-bold mb-4">Add Compliance Document</h1>

        <form action="{{ route('admin.compliance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Type <span class="text-danger">*</span></label>
                    <select name="doc_type" class="form-control" required>
                        <option value="">-- Select Type --</option>
                        <option value="12A">12A Certificate</option>
                        <option value="80G">80G Certificate</option>
                        <option value="FCRA">FCRA</option>
                        <option value="Trust Deed">Trust Deed</option>
                        <option value="Registration">Registration</option>
                        <option value="Annual Return">Annual Return</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Number</label>
                    <input type="text" name="doc_number" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Issue Date</label>
                    <input type="date" name="issue_date" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Issuing Authority</label>
                    <input type="text" name="authority" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Upload Document <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control" required>
                    <small class="text-muted">PDF / JPG / PNG (Max 2MB)</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3 d-flex align-items-center">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_public" value="1">
                        <label class="form-check-label">
                            Public Document
                        </label>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks" rows="3" class="form-control"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-success">
                Save Document
            </button>
            <a href="{{ route('admin.compliance.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>
    </div>
@endsection
