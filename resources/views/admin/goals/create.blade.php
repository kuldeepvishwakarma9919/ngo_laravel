@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Goal Tracking</h1>
            <a href="{{ route('admin.goals.create') }}" class="btn btn-dark">+ Add Goal</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <form method="POST" action="{{ route('admin.goals.store') }}">
                    @csrf
                    <input name="title" class="form-control mb-2" placeholder="Goal Title">
                    <input name="target_amount" class="form-control mb-2" placeholder="Target Amount">
                    <textarea name="description" class="form-control mb-2"></textarea>
                    <button class="btn btn-success">Save</button>
                </form>

            </div>
        </div>

    </div>
@endsection
