<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RoleController extends Controller
{
    public function index2() {}
    public function index()
    {
        $roles = Role::with('permissions')->get();
        // Permissions ko module ke hisaab se group kiya
        $groupedPermissions = Permission::all()->groupBy('module');
        $users = User::with('role')->get();

        return view('admin.roles.index', compact('roles', 'groupedPermissions', 'users'));
    }
    // Naya Role banane ke liye
    public function storeRole(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'note' => $request->note,
            'status' => 1,
        ]);
        return back()->with('success', 'Role ban gaya!');
    }

    // Role ko permissions assign karne ke liye
    public function assignPermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        // Sync method purani permissions hata kar nayi permissions add kar dega
        $role->permissions()->sync($request->permissions);
        return back()->with('success', 'Permissions update ho gayi!');
    }


    public function assignRoleToUser(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->role_id = $request->role_id;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Role updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!'
            ], 500);
        }
    }



    public function storePermission(Request $request)
    {
        $request->validate(['module' => 'required']);
        $actions = ['view', 'add', 'edit', 'delete'];

        foreach ($actions as $action) {
            $name = strtolower($request->module) . '_' . $action;
            // Check if exists, else create
            Permission::firstOrCreate(
                ['name' => $name],
                ['module' => ucfirst($request->module), 'action' => $action]
            );
        }

        return back()->with('success', 'Module Permissions (View, Add, Edit, Delete) Create Ho Gayi!');
    }

    public function manageRolePermissions($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $groupedPermissions = Permission::all()->groupBy('module');
        return view('admin.roles.manage', compact('role', 'groupedPermissions'));
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);


        if (\App\Models\User::where('role_id', $id)->count() > 0) {
            return redirect('/manage-roles')
                ->with('error', 'This role is assigned to users. Cannot delete.');
        }

        $role->delete();

        return redirect('/manage-roles')
            ->with('success', 'Role deleted successfully');
    }



    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $roles = Role::all();

        return view('admin.roles.index', compact('role', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('name', 'note'));
        return redirect('/manage-roles')
            ->with('success', 'Role updated successfully');
    }
}
