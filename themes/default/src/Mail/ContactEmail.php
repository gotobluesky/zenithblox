<?php

namespace Theme\Default\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class ContactEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function envelope()
    {
        return new Envelope( from:new  Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')), subject:'A New Contact Email');
    }
    
    public function content()
    {
        return new Content(
            view: 'theme/default::email.contact_mail',
            with: [
                'name' => $this->data->name,
                'email' => $this->data->email,
                'phone' => $this->data->phone,
                'company' => $this->data->company,
                'message' => $this->data->message,
            ],
        );
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->subject('A New Contact Email')
    //         ->markdown('theme/default::email.contact_mail',['data' => $this->data]);
    // }
}
