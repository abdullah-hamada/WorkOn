<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Inertia\Inertia;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Country/Index', [
            'countries' => Country::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(CountryRequest $request)
    {
        $status = Country::create([
            'name_ar' => $request->name_ar
        ]);
        if ($status) {
            return redirect('/admin/countries')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Country/Create');
    }

    public function edit($id)
    {
        $country = Country::where('id', $id)->first();
        if (!$country) {
            abort(404);
        }
        return Inertia::render('views/admin/Country/Edit', [
            'country' => $country,
        ]);
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);
        if (!$country) {
            abort(404);
        }
        $status = $country->update([
            'name_ar' => $request->name_ar
        ]);
        if ($status) {
            return redirect('/admin/countries')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        $status = $country->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

}
