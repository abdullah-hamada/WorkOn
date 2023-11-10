<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multaka;
use App\Models\MultakaSpeaker;
use App\Models\MultakaSpeakerOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaSpeakerOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $speakers = MultakaSpeaker::with(['multaka:id,title', 'country:id,name_ar'])
            ->when($request->multaka_id, function ($q) use ($request) {
                $q->where('multaka_id', $request->multaka_id);
            })->orderBy('status', 'asc')
            ->select('id', 'multaka_id', 'name', 'job_title', 'work_location', 'user_id', 'status', 'image', 'country_id')
            ->get();

        return Inertia::render('views/admin/Multaka/SpeakerOrder', [
            'speakers' => $speakers,
            'multakas' => Multaka::query()->orderByDesc('id')->select('id', 'title')->get(),
            'filters' => $request->only('multaka_id')
        ]);
    }

    public function change_status(Request $request)
    {
        $speaker = MultakaSpeaker::find($request->id);
        if (!$speaker) {
            abort(404);
        }
        if (!$speaker || !empty($speaker->status) || !in_array($request->status, [1, 2])) {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
        $status = $speaker->update([
            'status' => $request->status
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }
}