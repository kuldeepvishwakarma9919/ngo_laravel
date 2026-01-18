@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Add Volunteer</h4>

    <form method="POST" action="{{ route('admin.volunteers.store') }}">
        @csrf

        <input class="form-control mb-2" name="name" placeholder="Full Name" required>
        <input class="form-control mb-2" name="email" placeholder="Email">
        <input class="form-control mb-2" name="phone" placeholder="Phone">
        <input class="form-control mb-2" name="skills" placeholder="Skills">
        <input class="form-control mb-2" name="availability" placeholder="Availability">
        <textarea class="form-control mb-2" name="address" placeholder="Address"></textarea>

        <button class="btn btn-success">Save Volunteer</button>
    </form>
</div>
@endsection
