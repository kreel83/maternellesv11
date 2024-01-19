<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvoiLaDemandeDeContact;
use App\Mail\DemandeDeContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function envoiLaDemandeDeContact(EnvoiLaDemandeDeContact $request)
    {

        // $request->validate([
        //     'subject' => ['required', 'string', 'max:255'],
        //     'message' => ['required', 'string'],
        // ], [
        //     'subject.required' => 'Veuillez indiquer l\'objet du message',
        //     'subject.string' => 'Format de l\'objet incorrect',
        //     'subject.max' => 'L\'objet peut contenir au maximum 255 caractères',
        //     'message.required' => 'Veuillez indiquer le contenu de votre message',
        //     'message.string' => 'Format du message incorrect',
        // ]);

        // Sauvegarde du message dans la table 'contacts'
        Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        // Envoi d'un email pour nous prévenir
        $user = Auth::user();
        // Mail::to(env('MAIL_FROM_ADDRESS'))->send(new DemandeDeContact($user, $request->subject, $request->message));
        $to = explode(',', env('ADMIN_EMAILS'));
        Mail::to($to)->send(new DemandeDeContact($user, $request->subject, $request->message));
        return back()
            ->with('status', 'success')
            ->with('msg', 'Votre message a été envoyé.');

    }

}
