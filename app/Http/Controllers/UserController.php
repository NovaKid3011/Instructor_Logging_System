<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function table()
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect(route('dashboard'))
                    ->with('error', 'You are not authorized!');
            }elseif(Auth::user()->role == 0){
                $users = User::all();

                return view('user.table', compact('users'));
            }
        }
    }

    public function schedule($id)
    {

        $user = User::find($id);

        if (!$user) {
            return abort(404, 'User not found');
        }

        $schedule = Schedule::Where('Instructor_id', '=', $id)->get();

        return view('user.schedule', compact('user', 'schedule'));

    }
}
