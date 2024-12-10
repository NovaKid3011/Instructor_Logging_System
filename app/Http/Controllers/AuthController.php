<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect(route('dashboard'))
                 ->with('error', 'You are already logged in!');
            }else{
                return redirect(route('table'))
                    ->with('error', 'You are already logged in!');
            }
        }
        return view('auth.login');
    }

    public function register()
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect(route('dashboard'))
                ->with('error', 'You are already logged in!');
            }else{
                return redirect(route('table'))
                ->with('error', 'You are already logged in!');
            }
        }
        return view('auth.register');
    }

    public function dashboard()
    {
        if(Auth::user()->role == 1){
            $countUser = User::count();
            return view('layout.dashboard', compact('countUser'));
        }
        return redirect(route('table'))
            ->with('error', 'You are not authorized!');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials) && Auth::user()->role == 1){
            $request->session()->put('loginId', Auth::user()->id);
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login successfully!');
        }elseif(Auth::user()->role == 0){
            return redirect(route('table'))
                ->with('success', 'Login successfully!');
        }else{
            return redirect(route('login'))
                ->with('error', 'Login failed!');
        }
    }

    function registerPost(Request $request)
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
            return redirect(route('login'))
                ->with('success', 'User created successfully');
        }
        return redirect(route('register'))
            ->with('error', 'Failed to create account');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('login'));
    }

}
