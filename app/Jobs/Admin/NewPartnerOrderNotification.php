<?php

namespace App\Jobs\Admin;

use App\Mail\Admin\SendNewPartnerOrderMail;
   use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewPartnerOrderNotification implements ShouldQueue
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


        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();

        if (!empty($users)) {
            foreach ($users as $user) {
                $this->data['user_name'] = $user->name;
                Mail::to($user->email)->send(new SendNewPartnerOrderMail($this->data));

            }
        }
    }
}
