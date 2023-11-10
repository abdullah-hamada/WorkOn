<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LogoSettingRequest;
use App\Models\LogoSetting;
use Inertia\Inertia;

class LogoSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/LogoSetting/Index', [
            'logo_settings' => LogoSetting::first()
        ]);
    }

    public function store(LogoSettingRequest $request)
    {
        $logo = LogoSetting::first();
        $data['text'] = $request->text;
        if (isset($request->logo) && !empty($request->logo)) {
            uploadImage('work_net_logo', $request->logo);

            $data['logo'] = $request->logo->hashName();
        }
        $status = $logo->update($data);
        if ($status) {
            return redirect('/admin/logo_setting')->with('success', 'تم التحديث بنجاح');
        }
    }

}
