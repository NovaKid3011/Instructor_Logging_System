<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class InstructorController extends Controller
{
    public function index(){
        if(Auth::user()->role == 1) {
            return view('admin/instructor');
        }
        return redirect(route('dashboard'))->with('error', 'You are not authorized in this page!');
    }

    public function schedules(){
        if(Auth::user()->role == 1) {
            return view('admin/schedules');
        }
        return redirect(route('dashboard'))->with('error', 'You are not authorized in this page!');
    }

    public function showByLetter($alpha)
    {
        return view('user.letter')->with("alpha",$alpha);
    }
}
