<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvoiLaDemandeDeContact;
use App\Mail\DemandeDeContact;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function envoiLaDemandeDeContact(EnvoiLaDemandeDeContact $request)
    {
        // Sauvegarde du message dans la table 'contacts'
        Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        // Envoi d'un email pour nous prévenir
        Mail::to(config('app.mail'))->send(new DemandeDeContact(Auth::user(), $request->subject, $request->message));

        return back()
            ->with('status', 'success')
            ->with('msg', 'Votre message a été envoyé.');
    }

}
