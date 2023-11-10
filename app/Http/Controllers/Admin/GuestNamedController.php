<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GuestNamedRequest;
use App\Models\GuestNamed;
use Inertia\Inertia;

class GuestNamedController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/GuestNamed/Index', [
            'types' => GuestNamed::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(GuestNamedRequest $request)
    {
        $guest_named = GuestNamed::create([
            'name' => $request->name
        ]);
        if ($guest_named) {
            return redirect('/admin/guest_named')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }

    }

    public function create()
    {
        return Inertia::render('views/admin/GuestNamed/Create');
    }

    public function edit($id)
    {
        $guest_named = GuestNamed::where('id', $id)->first();
        return Inertia::render('views/admin/GuestNamed/Edit', [
            'guest_named' => $guest_named,

        ]);
    }


    public function update(GuestNamedRequest $request, $id)
    {

        $guest_named = GuestNamed::find($id);
        $status = $guest_named->update([
            'name' => $request->name,

        ]);
        if ($status) {
            return redirect('/admin/guest_named')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }

    }

    public function destroy($id)
    {
        $guest_named = GuestNamed::find($id);
        $status = $guest_named->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }


}
