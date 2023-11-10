<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\AdminNotification;
use App\Jobs\JobStepsNotification;
use App\Mail\SendCreateJobMail;
use App\Models\Category;
use App\Models\CompanyInformation;
use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\AuthService\RegisterService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request)
    {

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'whatsapp_number' => $request->whatsapp_number,
                'timezone' => getTimeZone(),
                'country_id' => $request->country_id,
                'category_id' => $request->category_id,

            ]);
            if ($user) {
                event(new Registered($user));

                Auth::login($user);
                if (isset($request->type) && $request->type == 'partner') {
                    \auth()->user()->assignRole('partner');
                } else {
                    \auth()->user()->assignRole('user');
                }
                DB::commit();
                return redirect(RouteServiceProvider::HOME)->with('success', 'تم التسجيل بنجاح');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return Inertia::render('views/Auth/Register', [
            'categories' => Category::all(),
            'countries' => Country::query()->select('id', 'name_ar')->get(),
            'user_type' => request()->type
        ]);
    }


}
