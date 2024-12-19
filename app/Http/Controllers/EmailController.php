<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostMail;
use App\Models\User;

class EmailController extends Controller
{
    public function create()
    {
        //
    }


    public function getEmail(Request $request)
    {

        $request->validate([
            'recipient' => 'required|email',
            'description' => 'nullable|string|max:255'
        ]);

        $email = $request->recipient;
        $content = $request->description;

        return redirect(route('users'))->with([
            'email' => $email,
            'content' => $content,
            'showModal' => true,
        ]);

        // return response()->json([
        //     'email' => $email,
        //     'content' => $content,
        //     'showmodal' => true
        // ]);

    }


    public function sendMail(Request $request)
    {

        $email = $request->input('email');
        $content = $request->input('content');


       Mail::to($email)->send(new PostMail($email, $content));

        return redirect(route('users'))->with('success', 'Sent Successfully');

    }
}
