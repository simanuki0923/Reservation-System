<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('mail.contact')
            ->subject('メッセージを受け付けました')
            ->from('sample@sample.com', 'テストメール事務局')
            ->subject('お知らせメール')
            ->with('data', $this->data);
    }
}