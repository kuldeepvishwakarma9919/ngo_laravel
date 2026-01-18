@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h4 fw-bold mb-4">Edit Campaign</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST"
                action="{{ route('admin.campaigns.update', $campaign->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Campaign Title</label>
                    <input type="text" name="title"
                        class="form-control"
                        value="{{ $campaign->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required>
                        {{ $campaign->description }}
                    </textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Target Amount (₹)</label>
                        <input type="number" name="target_amount"
                            class="form-control"
                            value="{{ $campaign->target_amount }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date"
                            class="form-control"
                            value="{{ $campaign->start_date }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date"
                            class="form-control"
                            value="{{ $campaign->end_date }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $campaign->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$campaign->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update Campaign</button>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>
@endsection
