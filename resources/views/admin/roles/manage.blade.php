@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Permissions for: <span class="text-primary">{{ $role->name }}</span></h2>
        <a href="/manage-roles" class="btn btn-secondary">Back to Roles</a>
    </div>

    <div class="card shadow-sm">
        <form action="/assign-permissions/{{ $role->id }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>Module Name</th>
                            <th>View</th>
                            <th>Add</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedPermissions as $moduleName => $permissions)
                        <tr>
                            <td class="font-weight-bold">{{ $moduleName }}</td>
                            @foreach(['view', 'add', 'edit', 'delete'] as $act)
                                <td class="text-center">
                                    @php $p = $permissions->where('action', $act)->first(); @endphp
                                    @if($p)
                                        <input type="checkbox" name="permissions[]" value="{{ $p->id }}" 
                                        {{ $role->permissions->contains($p->id) ? 'checked' : '' }}
                                        style="transform: scale(1.5);">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success px-5">Update {{ $role->name }} Permissions</button>
            </div>
        </form>
    </div>
</div>
@endsection