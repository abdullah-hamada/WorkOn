<?php

namespace App\Jobs\PartnerOrder\GeneralNotification;

use App\Mail\testMail;
use App\Models\CompanyJob;
use App\Models\TestData;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAcceptPartnerToUsersNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $partner_order;


    public function __construct($partner_order)
    {
        $this->partner_order = $partner_order;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->chunkById(40, function ($chunked_users) {
                dispatch(new SendAcceptPartnerToUserNotification($chunked_users ,$this->partner_order));
            });



    }
}
