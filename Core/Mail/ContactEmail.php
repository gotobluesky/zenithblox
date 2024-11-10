<?php

namespace Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $company;
    public $msg;
    public $demo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $company, $msg, $demo)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->msg = $msg;
        $this->demo = $demo;
    }
    
    public function envelope()
    {
        if($this->demo == true){
            $subject = 'A New Signup for Demo';
        }else{
            $subject = 'A New Contact Email';
        }
        
        return new Envelope( from:new  Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')), subject: $subject);
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function content()
    {
        return new Content(
            'theme/default::email.contact_mail'
        );
    }
    
}