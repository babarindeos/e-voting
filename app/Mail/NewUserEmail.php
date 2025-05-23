<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $fullname;
    public $username;
    public $password;
    public $email;

    public function __construct($payload)
    {
        //
        $this->fullname = $payload['fullname'];
        $this->username = $payload['username'];
        $this->password = $payload['password'];
        $this->email = $payload['email'];       

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Voter Registration for FUNAABSU Elections',
            bcc: 'babarindeos@funaab.edu.ng'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.new-user-email',
            with: ['fullname' => $this->fullname, 
                   'username' => $this->username, 
                   'password' => $this->password,
                   'email' => $this->email
                  ]
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
}
