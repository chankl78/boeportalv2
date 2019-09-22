<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserInfoNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $userId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $userId)
    {
        $this->data = $data;
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('templates.updateUserInfo')
            ->with(["data" => $this->data, "userId" => $this->userId]);
    }
}
