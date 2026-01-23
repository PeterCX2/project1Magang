<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('view film') || $user->hasPermissionTo('view user') || $user->hasPermissionTo('view category')) {
            return redirect()->route('admin.index');
        }

        if ($user->hasPermissionTo('view home')) {
            return redirect()->route('user.index');
        }

        abort(403, 'Role tidak dikenali.');
    }
}
