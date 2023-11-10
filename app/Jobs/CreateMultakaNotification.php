<?php

namespace App\Jobs;

use App\Models\Company_job;
use App\Models\FollowUpCompany;
use App\Models\JobRequestHistory;
use App\Models\Multaka;
use App\Models\User;
use App\Models\UserJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateMultakaNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $multaka_id;


    public function __construct($multaka_id)
    {
        $this->multaka_id = $multaka_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $multaka = Multaka::query()->find($this->multaka_id);


        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get();
        ////
        if (!empty($users)) {
            foreach ($users as $user) {
                send_notification('اشعار من الادارة',
                    'تم اضافة ملتقى جديد ( ' . $multaka->title . ' )  ', $user,
                    config('app.url') . 'multaka/' . $this->multaka);
            }
        }
    }
}
