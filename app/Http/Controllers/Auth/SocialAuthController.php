<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\Response;
use App\Jobs\AdminNotification;
use App\Jobs\JobStepsNotification;
use App\Mail\SendCreateJobMail;
use App\Models\MotivationalMessages;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Throwable;
use function redirect;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */

    public function handleProviderCallback($provider)
    {
        //now i have user information form his social account like:access Token
        try {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            return redirect('/dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
        } catch (Throwable $th) {
            throw $th;
        }
    }

    protected function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        } elseif ($authUser = User::where('email', $user->email)->first()) {
            return $authUser;
        } else {
            $user = User::create([
                'name' => ($user->name == null ? $user->nickname : $user->name),
                'email' => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'username' => ($user->name == null ? $user->nickname : $user->name),
                'email_verified_at' => Carbon::now(),
                'whatsapp_number' => ' ',
                'status' => ''
            ]);
            return $user;
        }
    }


}
