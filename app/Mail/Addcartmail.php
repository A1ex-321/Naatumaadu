<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Addcartmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // public $status;
    public $firstname;
    public $lastname;

    public function __construct($firstname,$lastname)
    {
        // $this->status = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nazairah',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mailapi',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    public function build()
    {
        // if ($this->status == null) {
        //     $this->status = '';
        // }
        // return $this->view('Mail1.Mail1');
        return $this->view('emails.mailapi')->subject('New Contact Form Submission')
        ->with([
            'first' => $this->firstname,
            'last' => $this->lastname,


        ]);    
    }
}
