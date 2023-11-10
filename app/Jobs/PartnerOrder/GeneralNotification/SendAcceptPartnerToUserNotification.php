<?php

namespace App\Jobs\PartnerOrder\GeneralNotification;

use App\Mail\JobPrograms\General\SendNotifyMail;
use App\Mail\PartnerOrder\SendAcceptPartnerToUsersMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAcceptPartnerToUserNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $chunked_data;
    public $partner_order;


    public function __construct($chunked_data, $partner_order)
    {
        $this->chunked_data = $chunked_data;
        $this->partner_order = $partner_order;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->chunked_data as $item) {
            Mail::to($item->email)->send(new SendAcceptPartnerToUsersMail([
                'name' => $item->name,
                'partner_order' => $this->partner_order,
                'partner_page_link'=>config('app.url') .'dashboard/user/show_partner/' . $this->partner_order->id,
                'partners_page_link'=>config('app.url') .'dashboard/user/partners'


            ]));
        }
    }
}
