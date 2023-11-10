<?php

namespace App\Mail\PartnerOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPartnerOrderRegisterGreetingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Work Net')->markdown('mail.PartnerOrder.send_partner_order_register_greeting_mail')->with('data', $this->data);
    }
}
