<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Attendance;
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

    public function schedule($id)
    {

        return view('user.schedule', ['employeeId' => $id]);

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

        $apiUrl1 = 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/' + $instructorId;
        $apiUrl2 = 'https://api-portal.mlgcl.edu.ph/api/external/employees';

        $response1 = Http::get($apiUrl1);
        $response2 = Http::get($apiUrl2);

        if($response1->successful() && $response2->successful()){
            $apiData1 = collect($response1->json());
            $apiData2 = collect($response2->json());

            $attendance = $apiData1->firstWhere('id', $scheduleId);
            $employee = $apiData2->firstWhere('id', $instructorId);

            if($attendance && $employee){
                Attendance::create([
                    'picture' => $fileName,
                    'first_name' => $employee['first_name'] ?? null,
                    'last_name' => $employee['last_name'] ?? null,
                    'subject_code' => $attendance['code'] ?? null,
                    'description' => $attendance['description'] ?? null,
                    'schedule' => $attendance['code'] ?? null,
                    'room' => $attendance['room'] ?? null,
                    'instructor_id' => $employee['id'] ?? null,
                ]);
            }
        }

        return back()->with('success', 'Timed in successfully!');
    }
}
