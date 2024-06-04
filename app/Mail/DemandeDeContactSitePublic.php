<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class DemandeDeContactSitePublic extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $body, $phone, $name, $email;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $phone, $name, $email)
    {        
        $this->subject = $subject;
        $this->body = $body;
        $this->phone = $phone;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->name),
            subject: $this->subject.' - '.config('app.name'),
        );
        // return new Envelope(
        //     from: new Address(config('mail.from.address'), $this->name),
        //     replyTo: [$this->email],
        //     subject: $this->subject.' - '.config('app.name'),
        // );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demandeDeContactSitePublic',
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
