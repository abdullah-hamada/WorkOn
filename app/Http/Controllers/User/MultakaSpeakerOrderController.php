<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MultakaSpeakerOrderRequest;
use App\Models\Country;
use App\Models\Multaka;
use App\Models\MultakaSpeaker;
use App\Models\MultakaSpeakerOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaSpeakerOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $speakers = MultakaSpeaker::with(['multaka:id,title', 'country:id,name_ar'])
            ->where('user_id', auth()->user()->id)
            ->select('id', 'multaka_id', 'name', 'job_title', 'work_location', 'user_id', 'status', 'image', 'country_id')
            ->orderBy('status', 'asc')->get();
        return Inertia::render('views/user/Multaka/SpeakerOrder', [
            'speakers' => $speakers,
            'multakas' => Multaka::where('date_from', '>=', Carbon::now()->format('Y-m-d'))->select('id', 'title', 'date_from')->get(),
            'countries' => Country::query()->select('id', 'name_ar')->get()

        ]);
    }

    public function store(MultakaSpeakerOrderRequest $request)
    {
        $multaka = Multaka::find($request->multaka_id);
        if (!$multaka) {
            abort(404);
        }

        if ($multaka->is_finish_apply) {
            return redirect()->back()->with('error', '  تم انتهاء وقت الاشتراك');
        }
        $speaker = MultakaSpeaker::query()->where('user_id', auth()->user()->id)
            ->where('multaka_id', $multaka->id)->first();

        if ($speaker) {
            return redirect()->back()->with('error', 'تم اضافة طلب من قبل');
        }

        uploadImage('multaka_speakers_images', $request->image);
        $status = MultakaSpeaker::query()->create([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'image' => $request->image->hashName(),
            'work_location' => $request->work_location,
            'country_id' => $request->country_id,
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
