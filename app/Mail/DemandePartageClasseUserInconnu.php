<?php

namespace App\Mail;

use App\utils\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandePartageClasseUserInconnu extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $nomDemandeur, $verificationLink;

    /**
     * Create a new message instance.
     */
    public function __construct($nomDemandeur, $verificationLink)
    {
        $this->logo = Utils::getLogoForMail();
        $this->nomDemandeur = $nomDemandeur;
        $this->verificationLink = $verificationLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->nomDemandeur.' souhaite partager sa classe avec vous',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.DemandePartageClasseUserInconnu',
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
