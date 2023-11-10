<?php


use App\Mail\SendCompanyJobStatusMail;
use App\Mail\SendCreateJobMail;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


function uploadImage($folder, $image)
{
    Storage::disk('local')->put('public/' . $folder, $image, 'public');
}

function deletePreviousImage($folder, $image)
{
    Storage::disk('local')->delete('/public/' . $folder . '/' . $image);
}


//function uploadImage($folder, $image)
//{
//
//    if($folder == 'website_images'){
//        Storage::disk('website_images')->put('/' , $image, 'public');
//    }else{
//        Storage::disk('local')->put('public/' . $folder, $image, 'public');
//    }
//}
//
//function deletePreviousImage($folder, $image)
//{
//    if($folder == 'website_images'){
//        Storage::disk('website_images')->delete('/' . $image);
//    }else {
//        Storage::disk('local')->delete('/public/' . $folder . '/' . $image);
//    }
//}

function send_notification($title, $body, $user, $link)
{
    Notification::query()->create([
        'user_id' => $user->id,
        'title' => $title,
        'text' => $body,
        'link' => $link,
        'created_at' => Carbon::now()->setTimezone('Asia/Gaza')
    ]);

    $data = [
        'first_name' => $user->first_name,
        'title' => $title,
        'text' => $body,
        'link' => $link
    ];
    Mail::to($user->email)->send(new \App\Mail\SendNotificationMail($data));
}


//function send_notification_steps($title, $body, $user, $link,$is_admin)
//{
//
//    $user=\App\Models\User::find($user['user_id']);
//    \App\Models\Notification::query()->create([
//        'user_id'=>$user->id,
//        'title'=>$title,
//        'text'=>$body,
//        'link'=>$link,
//        'send_to_admin'=>$is_admin,
//        'created_at'=>\Carbon\Carbon::now('Asia/Gaza')
//    ]);
//    $data=[
//        'first_name'=>$user->first_name,
//        'title'=>$title,
//        'text'=>$body,
//        'link'=> $link
//
//    ];
//    Mail::to($user->email)->send(new SendCreateJobMail($data));
//}
function send_company_job_status_notification($title, $body, $user, $link, $is_admin, $status_text)
{

    $user = User::find($user->id);
    Notification::query()->create([
        'user_id' => $user->id,
        'title' => $title,
        'text' => $body,
        'link' => $link,
        'send_to_admin' => $is_admin,
        'created_at' => Carbon::now()->setTimezone('Asia/Gaza')
    ]);
    $data = [
        'first_name' => $user->first_name,
        'title' => $title,
        'text' => $body,
        'link' => $link,
        'status_text' => $status_text

    ];
    Mail::to($user->email)->send(new SendCompanyJobStatusMail($data));
}


//function send_notification_admins ($title, $body, $users, $link){
//
//    foreach ($users as $user) {
//        \App\Models\Notification::query()->create([
//            'user_id'=>$user->id,
//            'title'=>$title,
//            'text'=>$body,
//            'link'=>env('APP_URL').$link,
//            'send_to_admin'=>'1',
//            'created_at'=>\Carbon\Carbon::now('Asia/Gaza')
//
//        ]);
//        $data=[
//            'first_name'=>$user->first_name,
//            'title'=>$title,
//            'text'=>$body,
//            'link'=>$link
//
//        ];
//        Mail::to($user->email)->send(new SendCreateJobMail($data));
//    }
//
//}

function translations($json)
{
    if (!file_exists($json)) {
        return [];
    }
    return json_decode(file_get_contents($json), true);
}


function getTimeZone()
{

    return 'Europe/Istanbul';

    if (auth()->check()) {
        return auth()->user()->timezone;
    } else {
        $url = 'http://ip-api.com/json/' . request()->ip();
        $tz = file_get_contents($url);
        $tz = json_decode($tz, true);

        if ($tz['status'] != 'fail') {

            return $tz['timezone'];
        } else {
            return 'Asia/Gaza';
        }
    }


}
