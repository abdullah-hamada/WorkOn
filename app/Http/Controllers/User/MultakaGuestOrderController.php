<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MultakaGuestOrderRequest;
use App\Models\Multaka;
use App\Models\MultakaGuest;
use App\Models\MultakaSpeakerOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaGuestOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        return Inertia::render('views/user/Multaka/GuestOrder', [
            'guest_orders' => MultakaGuest::with(['multaka:id,title'])
                ->where('user_id', auth()->user()->id)
                ->orderBy('status', 'asc')
                ->select('id', 'name', 'info', 'status', 'multaka_id', 'user_id')
                ->get(),
            'multakas' => Multaka::where('date_from', '>=', Carbon::now()->format('Y-m-d'))->select('id', 'title', 'date_from')->get(),
        ]);
    }

    public function save_multaka_guest_order(MultakaGuestOrderRequest $request)
    {
        $multaka = Multaka::find($request->multaka_id);
        if (!$multaka) {
            abort(404);
        }
        if ($multaka->is_finish_apply) {
            return redirect()->back()->with('error', '  تم انتهاء وقت الاشتراك');
        }
        $speaker = MultakaGuest::query()->where('user_id', auth()->user()->id)
            ->where('multaka_id', $multaka->id)->first();

        if ($speaker) {
            return redirect()->back()->with('error', 'تم اضافة طلب من قبل');
        }
        $status = MultakaGuest::query()->create([
            'name' => $request->name,
            'info' => $request->info,
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
