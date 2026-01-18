@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Role Management</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        {{ isset($role) ? 'Edit Role' : 'Create New Role' }}
                    </div>

                    <form
                        action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
                        method="POST" class="p-3">

                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        <input type="text" name="name" class="form-control" placeholder="Role Name"
                            value="{{ $role->name ?? '' }}" required>

                        <textarea name="note" class="form-control mt-3" placeholder="Note">{{ $role->note ?? '' }}</textarea>

                        <button class="btn btn_submit mt-2">
                            {{ isset($role) ? 'Update Role' : 'Create Role' }}
                        </button>
                    </form>

                </div>

                <div class="card shadow-sm">
                    <div class="card-header">Add New Module</div>
                    <form action="/create-permission" method="POST" class="p-3">
                        @csrf
                        <small class="text-muted">It will create View, Add, Edit, Delete automatically.</small>
                        <input type="text" name="module" placeholder="Module Name (e.g. Gallery)"
                            class="form-control mb-2" required>
                        <button class="btn btn_submit btn-block">Add Module</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">Available Roles</div>
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Note</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ strtoupper($role->name) }}</strong></td>
                                    <td><strong>{{ strtoupper($role->note ?? '') }}</strong></td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a href="{{ url('/manage-role-permissions/' . $role->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-lock"></i> Permissions
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
