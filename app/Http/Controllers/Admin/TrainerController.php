<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainerRequest;
use App\Models\Trainer;
use Inertia\Inertia;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Trainers/Index', [
            'trainers' => Trainer::query()
                ->select('id', 'name', 'image', 'job_title', 'email', 'mobile', 'status', 'created_at')
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function store(TrainerRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'job_title' => $request->job_title,
            'facebook_url' => $request->facebook_url,
            'linked_in_url' => $request->linked_in_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
            'website_url' => $request->website_url,
            'status' => 1
        ];

        if (isset($request->mobile) && !empty($request->mobile)) {
            $data['mobile'] = $request->mobile;
        }
        if (isset($request->email) && !empty($request->email)) {
            $data['email'] = $request->email;
        }
        if (isset($request->image) && !empty($request->image)) {
            uploadImage('trainer_images', $request->image);
            $data['image'] = $request->image->hashName();
        }
        $status = Trainer::create($data);
        if ($status) {
            return redirect('/admin/trainers')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Trainers/Create');
    }

    public function edit($id)
    {
        $trainer = Trainer::query()->where('id', $id)
            ->first();
        if (!$trainer) {
            abort(404);
        }
        return Inertia::render('views/admin/Trainers/Edit', [
            'trainer' => $trainer,
        ]);
    }

    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        deletePreviousImage('trainer_images', $trainer->image);
        $status = $trainer->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function change_status($id)
    {
        $trainer = Trainer::find($id);
        $status = $trainer->update([
            'status' => $trainer->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function update(TrainerRequest $request, $id)
    {
        $trainer = Trainer::query()->find($id);
        if (!$trainer) {
            abort(404);
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'job_title' => $request->job_title,
            'facebook_url' => $request->facebook_url,
            'linked_in_url' => $request->linked_in_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
            'website_url' => $request->website_url,
        ];

        if (isset($request->mobile) && !empty($request->mobile)) {
            $data['mobile'] = $request->mobile;
        }
        if (isset($request->email) && !empty($request->email)) {
            $data['email'] = $request->email;
        }
        if (isset($request->image) && !empty($request->image)) {
            deletePreviousImage('trainer_images', $trainer->image);
            uploadImage('trainer_images', $request->image);
            $data['image'] = $request->image->hashName();
        }
        $status = $trainer->update($data);
        if ($status) {
            return redirect('/admin/trainers')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }


}
