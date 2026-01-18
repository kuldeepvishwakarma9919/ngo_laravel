@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
<h1 class="h4 fw-bold mb-4">Create Team</h1>

<form method="POST" action="{{ route('admin.crowdfunding-teams.store') }}">
@csrf

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Campaign</label>
        <select name="campaign_id" class="form-control" required>
            @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Team Name</label>
        <input type="text" name="team_name" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Team Leader</label>
        <select name="leader_id" class="form-control">
            <option value="">-- Optional --</option>
            @foreach($leaders as $leader)
                <option value="{{ $leader->id }}">{{ $leader->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Target Amount</label>
        <input type="number" name="target_amount" class="form-control" required>
    </div>
</div>

<button class="btn btn-success">Save Team</button>
</form>
</div>
@endsection
