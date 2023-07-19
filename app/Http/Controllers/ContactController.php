<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    
    public function store(Request $request)
    {
        /*
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string']
        ]);
        */

        //\Log::info($request);

        $contact = Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        if($contact) {
            return('success');
        }

        return('failed');

    }

}
