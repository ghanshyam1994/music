<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $password;
    public $receiver;
    public $action;
    public $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataobject)
    {
        $this->name = isset($dataobject->name) ? $dataobject->name : '';
        $this->subject = isset($dataobject->subject) ? $dataobject->subject : '';
        $this->password = isset($dataobject->password) ? $dataobject->password : '';
        $this->receiver = isset($dataobject->receiver) ? $dataobject->receiver : '';
        $this->action = isset($dataobject->action) ? $dataobject->action : '';
        $this->order_id = isset($dataobject->order_id) ? $dataobject->order_id : 0;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('password-reset');

        /*return $this->from('sender@example.com')
            ->view('mails.demo')
            ->text('mails.demo_plain')
            ->with(
                [
                    'testVarOne' => '1',
                    'testVarTwo' => '2',
                ])
            ->attach(public_path('/images').'/demo.jpg', [
                'as' => 'demo.jpg',
                'mime' => 'image/jpeg',
            ]);*/
    }
}
