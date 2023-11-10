<?php

namespace App\Jobs;

use App\Models\Company_job;
use App\Models\Event;
use App\Models\FollowUpCompany;
use App\Models\JobRequestHistory;
use App\Models\User;
use App\Models\UserJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateEventNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $event_id;


    public function __construct($event_id)
    {
        $this->event_id = $event_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = Event::query()->find($this->event_id);


        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get();
        ////
        if (!empty($users)) {
            foreach ($users as $user) {
                send_notification('اشعار من الادارة',
                    'تم اضافة فعالية جديدة  ( ' . $event->title . ' )  ', $user,
                    config('app.url') . 'events/' . $this->event_id);
            }
        }
    }
}
