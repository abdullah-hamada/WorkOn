<?php

namespace App\Console\Commands;

use App\Mail\SendJobBelongToUserCategoryEveryWeekMail;
use App\Models\Company_job;
use App\Models\Event;
use App\Models\JobRequestHistory;
use App\Models\Quiz;
use App\Models\User;
use App\Models\UserSubscribe;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

class SendBeginEventReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendBeginEventReminderNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendBeginEventReminderNotification';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = Event::where('status', 1)
            ->where('date_from', '=', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->get();
        if ($events) {
            foreach ($events as $event) {
                $count_subscribe_user = UserSubscribe::query()->where('event_id', $event->id)->pluck('user_id');
                $users = User::query()->whereHas('roles', function ($q) {
                    $q->where('name', 'user');
                })->whereNotIn('id', $count_subscribe_user)
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'user');
                    })
                    ->get();
                if (!empty($users)) {
                    foreach ($users as $user) {
                        send_notification('اشعار من الادارة',
                            'باقي لبداية الفعالية يومين فقط سارع بالاشتراك   ( ' . $event->title . ' )  ', $user,
                            config('app.url') . 'events/' . $event->id);
                    }
                }
            }
        }
    }
}
