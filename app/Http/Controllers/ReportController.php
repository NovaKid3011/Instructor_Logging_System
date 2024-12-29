<?php 

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month');

        $attendanceQuery = Attendance::query();

        // Filter by search (first name or last name)
        if ($search) {
            $attendanceQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        // Filter by month
        if ($month) {
            $attendanceQuery->whereMonth('created_at', $month);
        }

        // Paginate the results
        $attendance = $attendanceQuery->paginate(10);

        return view('admin.report', compact('attendance', 'search', 'month'));
    }



public function showAttendance(Request $request)
{
    // Fetch data from the attendance table and group it by first_name, last_name, and month
    $attendance = Attendance::query()
        ->selectRaw('first_name, last_name, YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as attendance_count')
        ->groupBy('first_name', 'last_name', 'year', 'month')
        ->orderBy('first_name')
        ->orderBy('last_name')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
    
    return view('admin.report', compact('attendance'));
}

}
