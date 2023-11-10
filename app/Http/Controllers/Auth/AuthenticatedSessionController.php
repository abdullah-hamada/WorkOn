<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\CompanySession;
use App\Models\MotivationalMessages;
use App\Models\Session;
use App\Models\SessionDetails;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('views/Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }


    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request)
    {
//       $user= User::query()->where('email',$request->email)->where('password',Hash::make($request->password))->first();
//       dd(Hash::make($request->password));
//      if($user->status == 0){
//          return redirect()->back()->with('error', 'لا يمكن الدخول لانك مجمد');
//      }


        $user = User::query()->where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'timezone' => getTimeZone()
            ]);
        }


        $request->authenticate();
        $request->session()->regenerate();

        if (session('redirect_url') != null) {
            $url = session('redirect_url');
            session([
                'redirect_url' => null
            ]);
            return redirect($url);
        }

        if (\auth()->user()->hasRole('user') || \auth()->user()->hasRole('partner')) {
            return redirect('/dashboard');
        } else if (\auth()->user()->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function logout()
    {

        Auth::guard('web')->logout();
        return redirect('login');

    }


}
