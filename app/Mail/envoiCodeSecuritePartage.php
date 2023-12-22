<?php

namespace App\Mail;

use App\utils\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnvoiCodeSecuritePartage extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $code, $nomDemandeur;

    /**
     * Create a new message instance.
     */
    public function __construct($code, $nomDemandeur)
    {
        $this->logo = Utils::getBase64Image('img/deco/logo.png');
        $this->code = $code;
        $this->nomDemandeur = $nomDemandeur;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre code de sécurité',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.envoiCodeSecuritePartage',
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
