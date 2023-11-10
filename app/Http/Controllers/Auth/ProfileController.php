<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Notification;
use App\Services\AuthService\ProfileService;
use Carbon\Carbon;
use Inertia\Inertia;
use function auth;
use function request;

class ProfileController extends Controller
{
    public function profile()
    {
        return Inertia::render('views/Auth/Profile', [
            'user' => auth()->user(),
            'countries' => Country::all(),
            'categories' => Category::all()

        ]);
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'country_id' => $request->country_id,
            'category_id' => $request->category_id,
        ];
//        if (isset($request->website_url)) {
//            $data['website_url'] = $request->website_url;
//
//        }
//
//        if (isset($request->facebook_url)) {
//            $data['facebook_url'] = $request->facebook_url;
//
//        }
//
//        if (isset($request->instagram_url)) {
//            $data['instagram_url'] = $request->instagram_url;
//
//        }
//
//        if (isset($request->linkedIn_url)) {
//            $data['linkedIn_url'] = $request->linkedIn_url;
//
//        }
        if (isset($request->password)) {
            $data['password'] = bcrypt($request->password);

        }
        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            if (auth()->user()->image != null) {
                deletePreviousImage('user_images', auth()->user()->image);
            }
            uploadImage('user_images', $request->image);
        }

        $status = auth()->user()->update($data);
        if ($status) {

            return redirect('/profile')->with('success', '  تم التحديث بنجاح');
        }
    }

    public function notification()
    {
        Notification::query()->whereUserId(auth()->user()->id)->update([
            'is_read' => 1
        ]);
        $data = auth()->user()->notifications()->orderBy('id', 'desc')->limit(20)->get();


        $notifications = $data->keyBy('id')->map(function ($item) {
            return [
                'title' => __($item['title']),
                'text' => __($item['text']),
                'link' => $item['link'],
                'is_read' => $item['is_read'],
                'created_at' => Carbon::parse($item['created_at'])->format('H:i d-m-Y '),
            ];
        });


        return Inertia::render('Auth/Notification', [
            'all_notification' => $notifications
        ]);
    }


    public function make_notification_as_read()
    {
        $nofiy = Notification::query()->whereId(request()->notify_id)->first();
        $nofiy->update([
            'is_read' => 1
        ]);
        return response()->json(true);
    }

}
