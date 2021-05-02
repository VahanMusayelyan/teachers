<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $subject = $this->data['subject'];
        $text = $this->data['text'];
        
//        return $this->view('email.name');
        return $this->subject($subject)->view('emails.visitor_email',['content'=>$text,'img'=>$this->data['img']])->attach($this->data['img'],['as'=>$this->data['img']]);
    }
}
