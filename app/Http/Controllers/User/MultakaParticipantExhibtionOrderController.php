<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MultakaExhibitionOrderRequest;
use App\Models\Multaka;
use App\Models\MultakaParticipantExhibition;
use App\Models\MultakaSpeakerOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaParticipantExhibtionOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $participants = MultakaParticipantExhibition::with(['multaka:id,title'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('status', 'asc')
            ->select('id', 'company_name', 'company_person_authorized', 'multaka_id', 'user_id')
            ->get();
        return Inertia::render('views/user/Multaka/ParticipantsExhibitionOrder', [
            'participants' => $participants,
            'multakas' => Multaka::where('date_from', '>=', Carbon::now()->format('Y-m-d'))->select('id', 'title', 'date_from')->get(),

        ]);
    }

    public function save_multaka_participant_exhibition_order(MultakaExhibitionOrderRequest $request)
    {
        $multaka = Multaka::find($request->multaka_id);
        if (!$multaka) {
            abort(404);
        }
        if ($multaka->is_finish_apply) {
            return redirect()->back()->with('error', '  تم انتهاء وقت الاشتراك');
        }

        $order = MultakaParticipantExhibition::query()->where('user_id', auth()->user()->id)
            ->where('multaka_id', $multaka->id)->first();

        if ($order) {
            return redirect()->back()->with('error', 'تم اضافة طلب من قبل');
        }

        $status = MultakaParticipantExhibition::query()->create([
            'company_name' => $request->company_name,
            'company_person_authorized' => $request->company_person_authorized,
            'multaka_id' => $request->multaka_id,
            'user_id' => auth()->user()->id
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'تم اضافة الطلب بنجاح الرجاء انتظار الموافقة من قبل الادارة');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }
}
