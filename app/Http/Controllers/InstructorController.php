<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Attendance;

class InstructorController extends Controller
{
    public function index(){
        if(Auth::user()->role == 1) {
            return view('admin/instructor');
        }
        return redirect(route('dashboard'))->with('error', 'You are not authorized in this page!');
    }

    public function instructorMonthly(Request $request, $id)
    {
        $instructor = Attendance::where('instructor_id', $id)->exists();
        if ($instructor) {
            $month = $request->input('month');

            $attendanceQuery = Attendance::where('instructor_id', $id);

                // Filter by month
                if ($month) {
                    $attendanceQuery->whereMonth('created_at', $month);
                }
                // Paginate the results
                $attendances = $attendanceQuery->paginate(10);

                return view('admin.instructor-monthly', compact('attendances', 'month'));
        }else{
            return redirect(route('instructor'))->with('error', 'No attendance rarr found!');
        }

    }

    public function monthlyReport(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month');
        $instructorId = $request->query('instructor_id'); // Get instructor_id from the URL

        if (!$month || !$instructorId) {
            return redirect()->back()->with('error', 'Month and instructor selection are required.');
        }

        // Fetch attendance data based on the month, instructor, and optional search term
        $attendances = Attendance::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('subject_code', 'like', "%{$search}%");
            })
            ->whereMonth('created_at', $month)
            ->where('instructor_id', $instructorId)
            ->get();

        if ($attendances->isEmpty()) {
            return redirect()->back()->with('error', 'No attendance record found.');
        }

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
    }




    public function showByLetter($alpha)
{
    // Debugging
//    dd($alpha);

    return view('user.letter')->with('alpha', $alpha);
}
    public function schedule($id)
{

        return view('user.schedule', compact('instructor'));
}
}
