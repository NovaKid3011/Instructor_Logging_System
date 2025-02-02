<?php

namespace App\Http\Controllers;

use App\Models\Justification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $employeeApiUrl = "https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100";
        $scheduleApiUrl = "https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/" . $id;

        $apiKey = env('API_KEY');

        $employeeResponse = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Origin' => 'http://instructor-logging.test'
        ])->get($employeeApiUrl);

        $employeeData = $employeeResponse->json();

        $scheduleResponse = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Origin' => 'http://instructor-logging.test'
        ])->get($scheduleApiUrl);

        $scheduleData = $scheduleResponse->json();

        $employee = collect($employeeData['data'] ?? [])->firstWhere('id', (int) $id);

        $attendance = Attendance::where('instructor_id', $id)->get();
        $justification = Justification::where('instructor_id', $id)->get();

        return view('user.schedule', [
            'employee' => $employee,
            'employeeId' => $id,
            'schedules' => $scheduleData,
            'attendance' => $attendance,
            'justification' => $justification,
        ]);
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

        $today = Carbon::today()->toDateString();

        $request->validate([
            'first_name' => '',
            'last_name' => '',
            'subject_code' => '',
            'description' => '',
            'schedule' => '',
            'schedule_id' => '',
            'room' => '',
            'instructor_id' => '',
        ]);

        $attendance = new Attendance();
        $attendance->time_in = now();
        $attendance->date = $today;
        $attendance->photo = $fileName;
        $attendance->first_name = $request->first_name;
        $attendance->last_name = $request->last_name;
        $attendance->subject_code = $request->subject_code;
        $attendance->description = $request->description;
        $attendance->schedule = $request->schedule;
        $attendance->schedule_id = $request->schedule_id;
        $attendance->room = $request->room;
        $attendance->instructor_id = $request->instructor_id;

        if($attendance->save()){
            return back()->with('success', 'Timed in successfully!');
        }else{
            return back()->with('error', 'Timed in failed!');
        }

    }

    function justification(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'justification' => 'required|string',
            'date' => 'required',
        ]);

        $today = Carbon::today()->toDateString();

        $justification = new Justification();
        $justification->instructor_id = $request->instructor_id;
        $justification->schedule_id = $request->schedule_id;
        $justification->justification = $request->justification;
        $justification->absent_date = $request->date;
        $justification->current_date = $today;

        if($justification->save()){
            return back()->with('success', 'Justification submitted successfully!');
        }else{
            return back()->with('error', 'Justification submit failed!');
        }
    }
}
