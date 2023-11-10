<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubscribeMultakaRequest;
use App\Models\Multaka;
use App\Models\UserSubscribe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $multaka_items = Multaka::query();

        if (isset($request->title)) {
            $multaka_items = $multaka_items->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $multaka_items = $multaka_items->orderBy('id', $request->sort);
        } else {
            $multaka_items = $multaka_items->orderByDesc('id');
        }
        return Inertia::render('views/user/Multaka/Index', [
            'multaka_items' => $multaka_items
                ->with('type:id,name')
                ->select('id', 'title', 'brief_explanation', 'date_from', 'date_to', 'location_type', 'price_type', 'price_amount', 'type_id', 'status', 'image')
                ->whereActive()
                ->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()

        ]);
    }

    public function subscribe_multaka(SubscribeMultakaRequest $request, $id)
    {
        $multaka = Multaka::find($id);
        if (!$multaka) {
            return redirect()->back()->with('error', '     الملتقى غير موجود ');
        }
        if ($multaka->status == 0) {
            return redirect()->back()->with('error', '     الملتقى  مجمد ');
        }
        if (UserSubscribe::query()->where('multaka_id', $id)->where('user_id', auth()->user()->id)->count() > 0) {
            return redirect()->back()->with('error', '  تم الاشتراك مسبقا');
        }

//        if ($multaka->price_type == 2) {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'user_type' => $request->user_type,
            'user_id' => auth()->user()->id,
            'multaka_id' => $id,
        ];
        if (isset($request->job_title)) {
            $data['job_title'] = $request->job_title;

        }
        $subscribe = UserSubscribe::query()->create($data);
        if ($subscribe) {
            send_notification('اشعار من الادارة',
                'تم الاشتراك بالملتقى( ' . $multaka->title . ' ) بنجاح', auth()->user(),
                config('app.url') . 'events/' . $id);
            return redirect('/user_subscribers')->with('success', '  تم الاشتراك بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');

        }
//        } else {
//            return redirect()->back()->with('error', 'الدفع غير جاهز');
//        }
    }
}
