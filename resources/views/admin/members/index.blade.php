@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h4 fw-bold">Campaigns List</h1>
            <div class="export-btns">
                <a href="{{ route('admin.members.export.csv') }}" class="btn btn-dark btn-sm">
                    Export CSV
                </a>
                <a href="{{ route('admin.members.export.pdf') }}" class="btn btn-dark btn-sm">
                    Export PDF
                </a>
                <a href="" class="btn btn-dark btn-sm">
                    Add Member
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                Campaigns
            </div>

            <form method="GET" class=" mb-3 filter-card" action="{{ route('admin.members.index') }}">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- 🔍 Search -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" value="{{ request('name') }}" class="form-control"
                                placeholder="Search by Name">
                        </div>

                        <!-- 📅 From Date -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" name="city" value="{{ request('city') }}" class="form-control"
                                placeholder="City">
                        </div>

                        <!-- 📅 To Date -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Blood Group</label>
                            <input type="text" name="blade_group" value="{{ request('blade_group') }}"
                                class="form-control" placeholder="Blade Group">
                        </div>

                        <!-- 📌 Status -->
                        <div class="col-md-2">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-3 d-flex justify-content-between alugn-items-center">
                            <button class="btn btn-dark w-100 me-2">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </div>
            </form>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>ID Card No</th>
                            <th>Father Name</th>
                            <th>Gender</th>
                            <th>Blade Group</th>
                            <th>Occupation</th>
                            <th>Status</th>
                            <th>Roles</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $key => $member)
                            <tr>
                                {{-- <td>{{ $key + 1 }}</td> --}}
                                <td>
                                    @if ($member->photo)
                                        <img src="{{ Storage::url($member->photo) }}" width="50" height="50"
                                            class="rounded-circle">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td>{{ $member->user->name ?? 'N/A' }}</td>
                                <td>{{ $member->id_card_no }}</td>
                                <td>{{ $member->father_name }}</td>
                                <td>{{ ucfirst($member->gender) }}</td>
                                <td>{{ $member->blade_group }}</td>
                                <td>{{ $member->occupation }}</td>
                                <td>
                                    @if ($member->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <select name="role_id" class="form-select form-select-sm role-assigner"
                                        data-member-id="{{ $member->user_id }}">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ isset($member->user) && $member->user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="status-msg" style="display:none;"></small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($member->joined_date)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.members.qr', $member->id) }}" class="btn btn-sm btn-dark">
                                        QR
                                    </a>

                                    <a href="{{ route('admin.members.show', $member->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.members.edit', $member->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>

                                    <form action="{{ route('admin.members.toggle.status', $member->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $member->status == 1 ? 'btn-secondary' : 'btn-success' }}">
                                            {{ $member->status == 1 ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No members found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="record-info">
                    Showing
                    <strong>{{ $members->firstItem() }}</strong>
                    to
                    <strong>{{ $members->lastItem() }}</strong>
                    of
                    <strong>{{ $members->total() }}</strong>
                    campaigns
                </div>

                <div>
                    {{ $members->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.role-assigner').on('change', function() {
                var roleId = $(this).val();
                var userId = $(this).data('member-id');
                var selectElement = $(this);
                var statusMsg = selectElement.next('.status-msg');

                if (!roleId) return; // Agar "Select Role" chunna hai toh kuch na karein

                $.ajax({
                    url: "{{ url('/assign-role-to-user') }}/" + userId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        role_id: roleId
                    },
                    beforeSend: function() {
                        selectElement.css('opacity', '0.5'); // Loading effect
                    },
                    success: function(response) {
                        selectElement.css('opacity', '1');
                        statusMsg.text('Saved!').css('color', 'green').show().fadeOut(2000);
                    },
                    error: function(xhr) {
                        selectElement.css('opacity', '1');
                        alert('Error updating role. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
