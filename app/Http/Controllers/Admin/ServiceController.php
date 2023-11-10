<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Services/Index', [
            'services' => Service::query()->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function store(ServiceRequest $request)
    {
        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'paragraph' => $request->paragraph,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'status' => 1
        ];
        if (isset($request->image) && !empty($request->image)) {
            uploadImage('service_images', $request->image);
            $data['image'] = $request->image->hashName();
        }
        if (isset($request->description_image) && !empty($request->description_image)) {
            uploadImage('service_description_images', $request->description_image);
            $data['description_image'] = $request->description_image->hashName();
        }
        $status = Service::create($data);
        if ($status) {
            return redirect('/admin/services')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Services/Create');
    }

    public function edit($id)
    {
        $service = Service::query()->where('id', $id)->first();
        if (!$service) {
            abort(404);
        }
        return Inertia::render('views/admin/Services/Edit', [
            'service' => $service,
        ]);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $status = $service->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function change_status($id)
    {
        $service = Service::find($id);
        $status = $service->update([
            'status' => $service->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::query()->find($id);
        if (!$service) {
            abort(404);
        }

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'paragraph' => $request->paragraph,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
        ];
        if (isset($request->image) && !empty($request->image)) {
            deletePreviousImage('service_images', $service->image);
            uploadImage('service_images', $request->image);
            $data['image'] = $request->image->hashName();
        }
        if (isset($request->description_image) && !empty($request->description_image)) {
            deletePreviousImage('service_description_images', $service->description_image);
            uploadImage('service_description_images', $request->description_image);
            $data['description_image'] = $request->description_image->hashName();
        }

        $status = $service->update($data);


        if ($status) {
            return redirect('/admin/services')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }


}
