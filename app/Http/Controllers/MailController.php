<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;


class MailController extends Controller
{
    public function index() {
        $mails = Email::all();
        return view('admin.manage-emails', compact('mails'));
    }

    public function registerMail(Request $request) {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email',
        ]);

        $mail = new Email();
        $mail->fullname = $request->fname;
        $mail->email = $request->email;

        if ($mail->save())
        {
            return redirect(route('manage-emails'))
                ->with('success', 'Email added successfully');
        }
        return redirect(route('manage-emails'))
            ->with('error', 'Failed to add email');
    }

    public function editMail(Request $request, $id) {
        $email = Email::findOrFail($id);

        $request->validate([
            'edit_fname' => '',
            'edit_email' => '',
        ]);

        if($email){
            $email->fullname = $request->input('edit_fname', $email->fullname);
            $email->email = $request->input('edit_email', $email->email);
        }

        if ($email->save())
        {
            return redirect(route('manage-emails'))->with('success', 'Email updated successfully!');
        }
        return redirect(route('manage-emails'))->with('error', 'Email update failed!');
    }

    function deleteEmail($id)
    {
        $email = Email::findOrFail($id);
        $email->delete();

        return redirect(route('manage-emails'))->with('success', 'Email deleted successfully!');
    }

}
