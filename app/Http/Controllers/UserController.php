<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(){
        $users = User::with('roles', 'permissions')->paginate(8);
        return view('admin.users', compact('users'));
    }

    public function create(){
        $roles = Role::get();
        $permissions = Permission::get();
        return view('admin.createUser', compact('roles', 'permissions'));
    }
    
    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::get();
        $permissions = Permission::get();
        return view('admin.editUser', compact('user', 'roles', 'permissions'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $roles = $data['roles'];
        $user->syncRoles($roles);

        if ($request->filled('permissions') && !in_array('admin', $roles)) {
            $user->givePermissionTo($data['permissions']);
        }

        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully.');
    }



    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        $roles = $data['roles'];
        $user->syncRoles($roles);

        if ($request->filled('password')) {
            $data['password'] = 'required|string|min:8|confirmed';
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
