<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.index');
        } else {
            return abort(403, 'Role tidak dikenali.');
        }
    }
}