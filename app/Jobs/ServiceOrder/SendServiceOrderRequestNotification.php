<?php

namespace App\Jobs\ServiceOrder;

use App\Mail\ServiceOrder\SendServiceOrderRequestMail;
use App\Models\Company_job;
use App\Models\FollowUpCompany;
use App\Models\JobRequestHistory;
use App\Models\User;
use App\Models\UserJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendServiceOrderRequestNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        Mail::to($this->data['user']->email)->send(new SendServiceOrderRequestMail(  $this->data ,'user'));
        Mail::to($this->data['partner']->email)->send(new SendServiceOrderRequestMail(  $this->data ,'partner'));

        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();
        if (!empty($users)) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new SendServiceOrderRequestMail(  $this->data ,'admin'));
            }
        }
    }
}
