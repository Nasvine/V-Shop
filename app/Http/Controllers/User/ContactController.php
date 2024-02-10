<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $contact = new Contact();
        $contact->name     = $request->name;
        $contact->email    = $request->email;
        $contact->object   = $request->object;
        $contact->message  = $request->message;
        $contact->save();

        $mailcontact = [
            'name'    => $request->name,
            'email'   => $request->email,
            'object'  => $request->object,
            'message' => $request->message,
        ];

        Mail::to('vinenassara@gmail.com')->send(new \App\Mail\ContactMail($mailcontact));
        return redirect()->route('user.home')->with('success', 'Email sending successfully.');
    }
}
