<?php

namespace App\Mail;

use App\Models\Ecole;
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

    public $logo, $url, $ecole, $classeMail;

    /**
     * Create a new message instance.
     */
    public function __construct($url, $ecole, $classeMail)
    {
        $this->logo = Utils::getLogoForMail();
        $this->url = $url;
        $this->ecole = $ecole;
        $this->classeMail = $classeMail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // $ecole = Ecole::where('identifiant_de_l_etablissement', session('classe_active')->ecole_identifiant_de_l_etablissement)
        //     ->first();
        return new Envelope(
            // from: new Address(Auth::user()->email, Auth::user()->prenom.' '.Auth::user()->name),
            // from: new Address(Auth::user()->email, $ecole->nom_etablissement),
            from: new Address($this->ecole->mail, $this->ecole->nom_etablissement),
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
