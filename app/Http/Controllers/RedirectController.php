<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        }

        if ($user->hasRole('user')) {
            return redirect()->route('user.index');
        }

        abort(403, 'Role tidak dikenali.');
    }
}
