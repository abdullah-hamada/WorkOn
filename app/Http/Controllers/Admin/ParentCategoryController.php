<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerCategoryRequest;
use App\Models\PartnerCategory;
use App\Models\PartnerOrder;
use Inertia\Inertia;

class ParentCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/ParentCategory/Index', [
            'partner_categories' => PartnerCategory::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(PartnerCategoryRequest $request)
    {
        $status = PartnerCategory::create([
            'name' => $request->name
        ]);
        if ($status) {
            return redirect('/admin/parent_categories')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/ParentCategory/Create');
    }

    public function edit($id)
    {
        $category = PartnerCategory::where('id', $id)->first();
        if (!$category) {
            abort(404);
        }
        return Inertia::render('views/admin/ParentCategory/Edit', [
            'category' => $category,
        ]);
    }

    public function update(PartnerCategoryRequest $request, $id)
    {
        $category = PartnerCategory::find($id);
        if (!$category) {
            abort(404);
        }
        $status = $category->update([
            'name' => $request->name
        ]);
        if ($status) {
            return redirect('/admin/parent_categories')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function destroy($id)
    {
        $category = PartnerCategory::find($id);

        if (PartnerOrder::query()->where('parent_category_id', $category->id)->first()) {
            return redirect()->back()->with('error', 'لا يمكن الحذف لوجود طلب شراكة بنفس التخصص');

        }
        $status = $category->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

}
