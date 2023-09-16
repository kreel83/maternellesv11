<?php

namespace App\Http\Controllers;

use App\Mail\DemandeDeContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function store(Request $request)
    {

        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ], [
            'subject.required' => 'Veuillez indiquer l\'objet du message',
            'subject.string' => 'Format de l\'objet incorrect',
            'subject.max' => 'L\'objet peut contenir au maximum 255 caractères',
            'message.required' => 'Veuillez indiquer le contenu de votre message',
            'message.string' => 'Format du message incorrect',
        ]);

        // Sauvegarde du message dans la table 'contacts'
        Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        // Envoi d'un email pour nous prévenir
        $user = Auth::user();
        Mail::to("contact.clickweb@gmail.com")->send(new DemandeDeContact($user, $request->subject, $request->message));

        return back()->with(["result" => "success"]);

    }

}
