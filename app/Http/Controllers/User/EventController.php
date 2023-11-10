<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubscribeEventRequest;
use App\Models\Event;
use App\Models\UserRate;
use App\Models\UserSubscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $events = Event::orderByDesc('id');
        if (isset($request->title)) {
            $events = $events->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $events = $events->orderBy('date_from', $request->sort);
        } else {
            $events = $events->orderByDesc('id');
        }

        return Inertia::render('views/user/Events/Index', [
            'event_items' => $events->with('type:id,name')->whereActive()
                ->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()

        ]);
    }


    public function subscribe_event(SubscribeEventRequest $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', '     الفعالية غير موجودة ');
        }
        if ($event->status == 0) {
            return redirect()->back()->with('error', '     الفعالية  مجمدة ');
        }
        if (UserSubscribe::query()->where('event_id', $request->event_id)->where('user_id', auth()->user()->id)->count() > 0) {
            return redirect()->back()->with('error', '  تم الاشتراك مسبقا');
        }

        if ($event->is_finish_apply) {
            return redirect()->back()->with('error', '  تم انتهاء وقت الاشتراك');
        }
//        if ($event->price_type == 2) {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'user_type' => $request->user_type,
            'user_id' => auth()->user()->id,
            'event_id' => $id,
        ];
        if (isset($request->job_title)) {
            $data['job_title'] = $request->job_title;
        }
        $subscribe = UserSubscribe::query()->create($data);
        if ($subscribe) {
            send_notification('اشعار من الادارة',
                'تم الاشتراك بالفعالية( ' . $event->title . ' ) بنجاح', auth()->user(),
                config('app.url') . 'events/' . $id);
            return redirect('/user_subscribers')->with('success', '  تم الاشتراك بنجاح');
        } else {
            return redirect()->back()->with('success', 'حدث خطا ما');
        }
//        } else {
//            return redirect()->back()->with('error', 'الدفع غير جاهز');
//        }
    }

    public function rate(Request $request)
    {
        foreach ($request->rate_questions as $rate_question) {
            if ($rate_question['answer'] == null && $rate_question['normal_question_answer'] == null) {
                return redirect()->back()->with('error', 'الرجاء إدخال    جميع الاجابات  بالشكل الصحيح');
            }
        }
        foreach ($request->rate_questions as $rate_question) {

            $rate = UserRate::with('question')->find($rate_question['id']);
            if ($rate) {
                if ($rate->question->type == 1) {
                    $rate->update([
                        'normal_question_answer' => $rate_question['normal_question_answer'],
                        'date' => Carbon::now()
                    ]);
                } elseif ($rate->question->type == 2) {
                    $rate->update([
                        'answer' => $rate_question['answer'],
                        'date' => Carbon::now()
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'تم تقييم الفعالية بنجاح');
    }
}
