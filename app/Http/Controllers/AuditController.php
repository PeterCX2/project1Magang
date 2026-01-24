<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;


class AuditController extends Controller
{
    public function index(){
        $audits = Audit::with('user')->latest()->paginate(7);
        return view('admin.audits', compact('audits'));
    }

    public function show($id){
        $audit = Audit::with('user')->findOrFail($id);
        $audit->old_values = $audit->old_values ?? [];
        $audit->new_values = $audit->new_values ?? [];
        return view('admin.showAudit', compact('audit'));
    }

    public function delete($id){
        $audit = Audit::findOrFail($id);
        $audit->delete();
        return redirect()->route('admin.audits')->with('success', 'Audit log deleted successfully.');
    }
}