<?php

namespace App\Mail;

use App\Notification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $notification, $data, $s;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Notification $notification, $data, $s)
    {
        $this->notification = $notification;
        $this->data = $data;
        $this->s = $s;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::find($this->notification->user_id);

        return $this->subject($this->s)->view('emails.notif')->with([
            'notification' => $this->notification,
            'user' => $user,
            'data' => $this->data
        ]);
    }
}
