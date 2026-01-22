<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index(){
        $roles = Role::with('permissions')->paginate(7);
        return view('admin.roles', compact('roles'));
    }

    public function create(){
        $permissions = Permission::get();
        return view('admin.createRole', compact('permissions'));
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        return view('admin.editRole', compact('role', 'permissions'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $data['name']]);

        if ($request->filled('permissions')) {
            $role->givePermissionTo($data['permissions']);
        }

        return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $data['name'];
        $role->save();

        if ($request->filled('permissions')) {
            $role->syncPermissions($data['permissions']);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully.');
    }
}
