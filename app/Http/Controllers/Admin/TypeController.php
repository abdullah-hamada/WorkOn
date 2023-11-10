<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Models\Type;
use Inertia\Inertia;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Types/Index', [
            'types' => Type::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(TypeRequest $request)
    {
        $type = Type::create([
            'name' => $request->name
        ]);
        if ($type) {
            return redirect('/admin/types')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Types/Create');
    }

    public function edit($id)
    {
        $type = Type::where('id', $id)->first();
        return Inertia::render('views/admin/Types/Edit', [
            'type' => $type,

        ]);
    }


    public function update(TypeRequest $request, $id)
    {

        $type = Type::find($id);
        $status = $type->update([
            'name' => $request->name,

        ]);
        if ($status) {
            return redirect('/admin/types')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function destroy($id)
    {
        $type = Type::find($id);
        $status = $type->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }


}
