@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Project Locations</h1>
            <a href="{{ route('admin.project-locations.create') }}" class="btn btn-dark">+ Add Location</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <form method="POST" action="{{ route('admin.project-locations.store') }}">
                    @csrf
                    <input name="project_name" class="form-control mb-2" placeholder="Project Name">
                    <select name="campaign_id" class="form-control mb-2">
                        <option value="">Select Campaign</option>
                        @foreach ($campaigns as $camp)
                            <option value="{{ $camp->id }}">{{ $camp->title }}</option>
                        @endforeach
                    </select>

                    <input name="city" class="form-control mb-2" placeholder="City">
                    <input name="state" class="form-control mb-2" placeholder="State">

                    <input name="latitude" class="form-control mb-2" placeholder="Latitude">
                    <input name="longitude" class="form-control mb-2" placeholder="Longitude">

                    <button class="btn btn-success">Save Location</button>
                </form>

            </div>
        </div>

    </div>
@endsection
