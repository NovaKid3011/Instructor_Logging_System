<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Storage;

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

    public function schedule()
    {

        return view('user.schedule');

    }

    function store(Request $request, $instructorId, $scheduleId)
    {
        $img = $request->image;
        $folderPath = "public/";
        $image_parts = explode(';base64,', $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $rand_code = Str::random(6);
        $fileName = time() . $rand_code . '.png';
        $file = $folderPath . $fileName;

        return back();
    }
}
