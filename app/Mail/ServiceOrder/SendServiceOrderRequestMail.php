<?php

namespace App\Mail\ServiceOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendServiceOrderRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;
    public $role;

    public function __construct($data = [] , $role)
    {
        $this->data = $data;
        $this->role = $role;

    }

    public function build()
    {
        return $this->subject('Work Net')->markdown('mail.ServiceOrder.send_service_order_request_mail')->with([
            'data', $this->data,
            'role'=> $this->role
            ]);
    }
}
