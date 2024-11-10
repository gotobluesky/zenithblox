<?php

namespace Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class NewSubscriberWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }
    
    public function envelope()
    {
        return new Envelope( from:new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')), subject:"Thankyou for subscribing ".env('MAIL_FROM_NAME'));
        return new Envelope( from:new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')), subject:'You have a new subscriber');
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function content()
    {
        return new Content(
            'theme/default::email.subscriber_welcome'
        );
    }
    
}
