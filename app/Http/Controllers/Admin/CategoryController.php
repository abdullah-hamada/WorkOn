<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Category/Index', [
            'categories' => Category::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $status = Category::create([
            'name_ar' => $request->name_ar
        ]);
        if ($status) {
            return redirect('/admin/categories')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Category/Create');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            abort(404);
        }
        return Inertia::render('views/admin/Category/Edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $status = $category->update([
            'name_ar' => $request->name_ar
        ]);
        if ($status) {
            return redirect('/admin/categories')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $status = $category->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

}
