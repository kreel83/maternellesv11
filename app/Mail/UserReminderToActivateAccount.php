<?php

namespace App\Mail;

use App\utils\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserReminderToActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $verificationLink, $prenom;

    /**
     * Create a new message instance.
     */
    public function __construct($verificationLink, $prenom)
    {
        $this->logo = Utils::getBase64Image('img/deco/logo.png');
        $this->verificationLink = $verificationLink;
        $this->prenom = $prenom;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Activez votre compte - Les Maternelles',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.userReminderToActivateAccount',
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
