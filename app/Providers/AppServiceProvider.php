<?php

namespace App\Providers;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//        VerifyEmail::toMailUsing(function ($notifiable, $url) {
//            return (new MailMessage())
//                ->subject('Verify Email Address')
//                ->action('Verify Email Address', $url)
//                ->view('emails.verify', compact('url'));
//        });
    }
}
