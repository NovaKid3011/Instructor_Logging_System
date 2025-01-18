<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        return view('user.schedule', ['employeeId' => $id]);

    }

    function store(Request $request, $instructorId, $scheduleId)
    {
        $img = $request->image;
        $folderPath = "webcam/";
        $image_parts = explode(';base64,', $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $rand_code = Str::random(6);
        $fileName = time() . $rand_code . '.png';
        $file = $folderPath . $fileName;

        Storage::disk('public')->put($file, $image_base64);

        $request->validate([
            'first_name' => '',
            'last_name' => '',
            'subject_code' => '',
            'description' => '',
            'schedule' => '',
            'room' => '',
            'instructor_id' => '',
        ]);

        $attendance = new Attendance();
        $attendance->time_in = now();
        $attendance->photo = $fileName;
        $attendance->first_name = $request->first_name;
        $attendance->last_name = $request->last_name;
        $attendance->subject_code = $request->subject_code;
        $attendance->description = $request->description;
        $attendance->schedule = $request->schedule;
        $attendance->room = $request->room;
        $attendance->instructor_id = $request->instructor_id;
        if($attendance->save()){
            return back()->with('success', 'Timed in successfully!');
        }else{
            return back()->with('error', 'Timed in failed!');
        }
    }
}
