<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InstructorController extends Controller
{
    public function index(){
        if(Auth::user()->role == 1) {
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY'),
                'Origin' => 'http://instructor-logging.test'
            ])->get('https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100');

            if($response->successful()) {
                $data = $response->json()['data'] ?? [];
                $selectedIds = DB::table('instructors')->pluck('employee_id')->toArray();

                foreach($data as &$item) {
                    $item['selected'] = in_array($item['id'], $selectedIds);
                }
                return view('admin.instructor', ['data' => $data]);
            }else{
                return view('admin.instructor')->with('error', 'cannot fetch data');
            }
        }
        return redirect(route('dashboard'))->with('error', 'You are not authorized in this page!');
    }

    public function instructorMonthly(Request $request, $id)
    {
        $instructor = Attendance::where('instructor_id', $id)->exists();

        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY'),
            'Origin' => 'http://instructor-logging.test'
        ])->get('https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100');

        if($response->successful()) {
            $data = $response->json()['data'] ?? [];

            foreach($data as &$items) {
                $items['selected'] = $items['id'] == $id;
            }
            if($request->input('month') == null){
                $month = date('m');
            }else{
                $month = $request->input('month');
            }

            $attendanceQuery = Attendance::where('instructor_id', $id);
            if ($month) {
                $attendanceQuery->whereMonth('created_at', $month);
            }
            $attendances = $attendanceQuery->paginate(10);
            return view('admin.instructor-monthly', compact('attendances', 'month'))->with(['data' => $data]);
        }

    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month');
        $instructorId = $request->input('instructor_id'); // Get instructor_id from the URL

        if(!$month) {
            $month = date('m');
        }
        if (!$month || !$instructorId) {
            return redirect()->back()->with('error', 'Month and instructor selection are required.');
        }

        $attendances = Attendance::query()
            ->whereMonth('created_at', $month)
            ->where('instructor_id', $instructorId)
            ->get();
        if ($attendances->isEmpty()) {
            return redirect()->back()->with('error', 'No attendance record found.');
        }

        if($request->input('download') == 1){
            $fileName = 'Attendance_Report_' . now()->format('m-d-Y') . '.csv';

            return response()->stream(function () use ($attendances) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Time In', 'Name', 'Subject Code', 'Description', 'Schedule', 'Room', 'Justification']);
                foreach ($attendances as $attendance) {
                    fputcsv($file, [
                        $attendance->created_at->format('h:i A'),
                        "{$attendance->first_name} {$attendance->last_name}",
                        $attendance->subject_code ?? 'N/A',
                        $attendance->description ?? 'N/A',
                        $attendance->schedule ?? 'N/A',
                        $attendance->room ?? 'N/A',
                        $attendance->justification ?? 'N/A',
                    ]);
                }

                fclose($file);
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            ]);
        }elseif($request->input('download') == 2) {
            $instructorAtt = Attendance::where('instructor_id', $instructorId)->get();
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY'),
                'Origin' => 'http://instructor-logging.test'
            ])->get('https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100');
            $data = $response->json()['data'] ?? [];
            $employee = array_filter($data, function ($item) use ($instructorId) {
                return $item['id'] == $instructorId;
            });
            $employee = reset($employee);
            $fileName = 'Attendance_Report_' . $month . '.pdf';
            $dompdf = Pdf::loadView('layout.partials.pdf', compact('instructorAtt', 'employee'));
            $dompdf->render();

            return response()->streamDownload(function () use ($dompdf) {
                echo $dompdf->output(); // Stream the PDF content
            }, $fileName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);

        }elseif($request->input('download') == 3) {
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY'),
                'Origin' => 'http://instructor-logging.test'
            ])->get('https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100');
            $data = $response->json()['data'] ?? [];
            $instructorAtt = Attendance::where('instructor_id', $instructorId)->get();
            $employee = array_filter($data, function ($item) use ($instructorId) {
                return $item['id'] == $instructorId;
            });
            $employee = reset($employee);

            return view('layout.partials.print', compact('employee', 'instructorAtt'));
        }
    }

    public function showByLetter($alpha)
    {
        $api_key = env('API_KEY');
        $response = Http::withHeaders([
            'x-api-key' => $api_key,
            'Origin' => 'http://instructor-logging.test'
        ])->get("https://api-portal.mlgcl.edu.ph/api/external/employees", [
            'last_name' => strtoupper($alpha)
        ]);

        if ($response->failed()) {
            return redirect(route('table'))->with('error', 'Failed to fetch data from API.');
        }

        $data = $response->json()['data'] ?? [];

        // Fetch part-time instructor employee IDs from the database
        $partTimeInstructorIds = DB::table('instructors')->pluck('employee_id')->toArray();

        foreach ($data as &$item) {
            $item['is_part_time'] = in_array($item['id'], $partTimeInstructorIds);
        }

        return view('user.letter', compact('alpha', 'data'));
    }
}


