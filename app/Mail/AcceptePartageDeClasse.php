<?php

namespace App\Mail;

use App\utils\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AcceptePartageDeClasse extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $prenom, $accepteurName, $accepteurPrenom;

    /**
     * Create a new message instance.
     */
    public function __construct($prenom, $accepteurName, $accepteurPrenom)
    {
        $this->logo = Utils::getLogoForMail();
        $this->prenom = $prenom;
        $this->accepteurName = $accepteurName;
        $this->accepteurPrenom = $accepteurPrenom;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande de partage de classe a été acceptée',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.acceptePartageDeClasse',
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
