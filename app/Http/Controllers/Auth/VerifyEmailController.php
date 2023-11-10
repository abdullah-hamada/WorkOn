<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use function auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        if (auth()->user()->hasRole('user')) {
            send_notification('اشعار من الادارة',
                'اهلا وسهلا بك في ورك نت', auth()->user(),
                config('app.url') . 'dashboard');
            if (session('redirect_url') != null) {
                $url = session('redirect_url');
                session([
                    'redirect_url' => null
                ]);
                return redirect($url)->with('success', 'تم التحقق من البريد بنجاح');
            } else {
                return redirect('/dashboard')->with('success', 'تم التحقق من البريد بنجاح');
            }
        }
//
//        else if (\auth()->user()->hasRole('admin')) {
//            return redirect('/admin/dashboard')->with('success', 'تم التحقق من البريد بنجاح');
//        }


//        return redirect('/?verified=1');
//        /->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
