<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $contact = Contacts::create([
            'id_user' => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'message' => 'Your message has been sent successfully!',
            'contact' => $contact,
        ], 201);
    }
}