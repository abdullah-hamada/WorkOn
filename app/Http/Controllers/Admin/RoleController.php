<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        return Inertia::render('views/admin/Roles', [
            'roles' => Role::query()->orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::query()->create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        if ($role) {
            return redirect()->back()->with('success', 'تم الحفظ بنجاح');
        }
    }

    public function edit($id)
    {
        return response()->json(Role::find($id));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $status = $role->update([
            'name' => $request->name,
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'تم التحديث بنجاح');
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $status = $role->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
    }

}
