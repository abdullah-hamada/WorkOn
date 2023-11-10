<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multaka;
use App\Models\MultakaParticipantExhibition;
use App\Models\MultakaSpeakerOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaParticipantExhibtionOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $participants = MultakaParticipantExhibition::with(['multaka:id,title'])
            ->when($request->multaka_id, function ($q) use ($request) {
                $q->where('multaka_id', $request->multaka_id);
            })
            ->orderBy('status', 'asc')
            ->select('id', 'company_name', 'company_person_authorized', 'multaka_id', 'user_id')
            ->get();

        return Inertia::render('views/admin/Multaka/ParticipantsExhibitionOrder', [
            'participants' => $participants,
            'multakas' => Multaka::query()->orderByDesc('id')->select('id', 'title')->get(),
            'filters' => $request->only('multaka_id')
        ]);
    }

    public function change_status(Request $request)
    {
        $participant_order = MultakaParticipantExhibition::find($request->id);

        if (!$participant_order || !empty($participant_order->status) || !in_array($request->status, [1, 2])) {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
        $status = $participant_order->update([
            'status' => $request->status
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }
}
