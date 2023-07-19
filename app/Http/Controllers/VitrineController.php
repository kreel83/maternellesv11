<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VitrineController extends Controller
{
    
    public function index(): View {
        return view('vitrine.index');
    }

    public function cahier(): View {
        return view('vitrine.cahier');
    }

    public function eleves(): View {
        return view('vitrine.eleves');
    }

    public function fiches(): View {
        return view('vitrine.fiches');
    }

    public function calendrier(): View {
        return view('vitrine.calendrier');
    }

    public function parametrage(): View {
        return view('vitrine.parametrage');
    }

    public function compagnon(): View {
        return view('vitrine.compagnon');
    }

    public function tarif(): View {
        return view('vitrine.tarif');
    }

    public function conditions(): View {
        return view('vitrine.conditions');
    }

    public function mentions(): View {
        return view('vitrine.mentions');
    }

    public function confidentialite(): View {
        return view('vitrine.confidentialite');
    }

    public function cookies(): View {
        return view('vitrine.cookies');
    }

    public function contact(): View {
        return view('vitrine.contact');
    }

    public function contactSend(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1024'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom est limité à 255 caractères.',
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'subject.required' => 'L\'objet du message est obligatoire.',
            'subject.max' => 'L\'objet du message est limité à 255 caractères.',
            'message.required' => 'Le message est obligatoire.',
            'message.max' => 'Le message est limité à 1024 caractères.',
        ]);


        Contact::create([
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return view('vitrine.contact-send');

    }

}
