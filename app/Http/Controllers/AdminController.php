<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile()
    {
        if(Auth::user()->role == 1){
            return view('admin.profile');
        }
        return redirect(route('table'))
            ->with('error', 'You are not authorized');
    }

    public function users()
    {
        if(Auth::user()->role == 1){
            $users = User::all();

            return view('admin.users', compact('users'));
        }
        return redirect(route('dashboard'))
        ->with('error', 'You are not authorized to access this page!');
    }

    public function create(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save())
        {
            return redirect(route('users'))
            ->with('success', 'User created successfully!');
        }
        return redirect(route('users'))->with('error', 'User has not created successfully!');
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('users'))->with('success', 'User deleted successfully!');
    }

    function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'edit_fname' => 'nullable|string|max:255',
            'edit_lname' => 'nullable|string|max:255',
            'edit_email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'current_password' => '',
            'edit_password' => '',
            'confirm_password' => '',
        ]);

        if($request->edit_fname && $request->edit_fname !== $user->first_name){
            $user->first_name = $request->first_name;
        }

        if($request->edit_lname && $request->edit_lname !== $user->last_name){
            $user->last_name = $request->last_name;
        }

        if($request->edit_email && $request->edit_email !== $user->email){
            $user->email = $request->email;
        }

        if($request->current_password){
            if(!Hash::check($request->current_password, $user->password)){
                return back()->with('error', 'The current password is incorrect!');
            }else{
                if($request->edit_password == $request->confirm_password){
                    $user->password = Hash::make($request->input('edit_password', $user->password));
                }else{
                    return back()->with('error', 'The password does not match!');
                }
            }
        }

        if ($user->save())
        {
            return redirect(route('users'))->with('success', 'User updated successfully!');
        }
        return redirect(route('users'))->with('error', 'User has not updated successfully!');
    }
}
