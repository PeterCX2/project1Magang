<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use OwenIt\Auditing\Models\Audit;

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

        // CREATE ROLE
        $role = Role::create([
            'name' => $data['name'],
        ]);

        // ASSIGN PERMISSIONS
        if ($request->filled('permissions')) {
            $role->givePermissionTo($data['permissions']);
        }

        // AUDIT CREATE ROLE
        Audit::create([
            'user_id' => auth()->user()->id,
            'event' => 'role_created',
            'auditable_type' => Role::class,
            'auditable_id' => $role->id,
            'old_values' => null,
            'new_values' => [
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(),
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($id);

        $oldData = [
            'name' => $role->name,
            'permissions' => $role->permissions->pluck('name')->toArray(),
        ];

        $role->name = $data['name'];
        $role->save();

        if ($request->filled('permissions')) {
            $role->syncPermissions($data['permissions']);
        } else {
            $role->syncPermissions([]);
        }

         $newData = [
            'name' => $role->name,
            'permissions' => $role->permissions->pluck('name')->toArray(),
        ];

        Audit::create([
            'user_id' => auth()->user()->id,
            'event' => 'updated',
            'auditable_type' => Role::class,
            'auditable_id' => $role->id,
            'old_values' => $oldData,
            'new_values' => $newData,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully.');
    }
}
