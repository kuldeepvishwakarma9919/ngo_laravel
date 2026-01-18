@extends('admin.masters.layouts.app')


@section('content')
    <div class="container-fluid">

        <h1 class="h4 fw-bold mb-4">Site Settings</h1>

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.audit-reports.store') }}">
            @csrf

            <input name="title" class="form-control mb-2" placeholder="Report Title">

            <input name="financial_year" class="form-control mb-2" placeholder="2024-25">

            <select name="report_type" class="form-control mb-2">
                <option>Domestic</option>
                <option>FCRA</option>
                <option>ITR</option>
                <option>Annual_Report</option>
                <option>Other</option>
            </select>

            <input name="ca_name" class="form-control mb-2" placeholder="CA Name">
            <input name="udid_number" class="form-control mb-2" placeholder="UDIN No">

            <textarea name="summary" class="form-control mb-2" placeholder="Audit Summary"></textarea>

            <label>Public</label>
            <input type="checkbox" name="is_public" value="1" checked>

            <input type="file" name="file" class="form-control mt-2">

            <button class="btn btn-success mt-3">Save</button>
        </form>


    </div>
@endsection
