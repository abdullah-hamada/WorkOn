<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SendSubscribeCourseMail;
use App\Models\Course;
use App\Models\UserSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TapPaymentController extends Controller
{
    public function payment($id)
    {
        $course = Course::where('id', $id)->whereActive()->first();
        if (!$course) {
            return redirect()->back()->with('error', '     الدورة غير موجودة ');
        }

        if (auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'لا يمكنك الاشتراك لانك مدير ');
        }
        if (UserSubscribe::query()->where('course_id', $id)->where('user_id', auth()->user()->id)->count() > 0) {
            return redirect()->back()->with('error', '  تم الاشتراك مسبقا');
        }

        if ($course->price_type == 2) {
            $subscribe = UserSubscribe::query()->create([
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
            ]);
            if ($subscribe) {
                $data = [
                    'course_title' => $course->title,
                    'user_name' => auth()->user()->name,
                    'link' => config('app.url') . '/user_subscribers'
                ];
                Mail::to(auth()->user()->email)->send(new SendSubscribeCourseMail($data));
                return redirect('/course/' . $course->id)->with('success', '  تم الاشتراك بنجاح');
            } else {
                return redirect()->back()->with('error', 'حدث خطا ما');
            }
        }

        $payment = [
            "amount" => round($course->price_after_discount, 2),
            "description" => 'Hello ' . auth()->user()->name . ' You will participate in the course ' . $course->title . ' please pay and confirm your order  .',
            "currency" => 'USD',
            "receipt" => [
                "email" => auth()->user()->email,
                "sms" => true
            ],
            "customer" => [
                "first_name" => auth()->user()->name,
                "last_name" => '',
                "email" => auth()->user()->email,
                "phone" => [
//                    "country_code" => 'IN',
                    "number" => auth()->user()->whatsapp_number
                ]
            ],
            "source" => [
                "id" => "src_card"
            ],
            'metadata' => [
                'course_id' => $course->id,  # Example special data: Order ID
                'source' => 'Work_Net',  # Example special data: Customer name,
                'user_id' => auth()->user()->id
            ],
            "redirect" => [
                "url" => route('tap.callback')
            ]
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payment),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer sk_live_PBW7kauOIRZgl4zXfmyCNFsq", // SECRET API KEY
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response = json_decode($response);
        return redirect($response->transaction->url);
    }

    public function callback(Request $request)
    {

        $input = $request->all();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges/" . $input['tap_id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer sk_live_PBW7kauOIRZgl4zXfmyCNFsq" // SECRET API KEY
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $responseTap = json_decode($response);
        if ($responseTap->status == 'CAPTURED') {
            $subscribe = UserSubscribe::query()->create([
                'user_id' => auth()->user()->id,
                'course_id' => $responseTap->metadata->course_id,
                'charge_id' => $responseTap->id,
                'amount' => $responseTap->amount,
                'card' => $responseTap->card->brand . "-" . $responseTap->card->first_six . "-" . $responseTap->card->last_four
            ]);
            if ($subscribe) {
                $course = Course::find($responseTap->metadata->course_id);
                $data = [
                    'course_title' => $course->title,
                    'user_name' => auth()->user()->name,
                    'link' => config('app.url') . '/user_subscribers'

                ];
                Mail::to(auth()->user()->email)->send(new SendSubscribeCourseMail($data));
                return redirect('/course/' . $course->id)->with('success', '  تم الاشتراك بنجاح');
            } else {
                return redirect()->back()->with('error', 'حدث خطا ما');
            }
        }
        return redirect()->back()->with('error', 'حدث خطا ما');
    }
}
