@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Add Beneficiary</h4>

    <form method="POST" action="{{ route('admin.beneficiaries.store') }}">
        @csrf

        <input class="form-control mb-2" name="name" placeholder="Full Name" required>
        <input class="form-control mb-2" name="phone" placeholder="Phone">
        <input class="form-control mb-2" name="email" placeholder="Email">

        <select class="form-control mb-2" name="category">
            <option>Student</option>
            <option>Patient</option>
            <option>Family</option>
        </select>

        <select class="form-control mb-2" name="support_type">
            <option>Education</option>
            <option>Medical</option>
            <option>Food</option>
            <option>Financial</option>
        </select>

        <textarea class="form-control mb-2" name="address" placeholder="Address"></textarea>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
