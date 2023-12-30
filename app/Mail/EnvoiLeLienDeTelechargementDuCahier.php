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
use Illuminate\Mail\Mailables\Address;

class EnvoiLeLienDeTelechargementDuCahier extends Mailable
{
    use Queueable, SerializesModels;

    public $logo, $url;

    /**
     * Create a new message instance.
     */
    public function __construct($url)
    {
        $this->logo = Utils::getLogoForMail();
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Auth::user()->email, Auth::user()->prenom.' '.Auth::user()->name),
            subject: 'Téléchargement du cahier de réussites de votre enfant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.EnvoiLeLienDeTelechargementDuCahier',
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
