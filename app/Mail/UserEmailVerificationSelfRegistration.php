<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserEmailVerificationSelfRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $verificationLink, $prenom;

    /**
     * Create a new message instance.
     */
    public function __construct($logo, $url, $prenom)
    {
        $this->logo = $logo;
        $this->verificationLink = $url;
        $this->prenom = $prenom;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vérifiez votre adresse mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.userEmailVerificationSelfRegistration',
            text: 'emails.userEmailVerificationSelfRegistration-text'
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
