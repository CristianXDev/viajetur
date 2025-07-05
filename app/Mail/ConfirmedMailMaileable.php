<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmedMailMaileable extends Mailable{

    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos){
    
     $this->datos = $datos;

    }

    public function envelope(): Envelope{

        return new Envelope(
            subject: 'Confirmed Email',
        );
    }

    public function content(): Content{

        return new Content(
            view: 'mail.confirmed_mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array{
        return [];
    }


    public function build(){

        $this->view('mail.confirmed_mail');
    }
}
