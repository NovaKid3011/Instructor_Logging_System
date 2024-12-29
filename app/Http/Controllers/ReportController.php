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

        if ($search) {
            $attendanceQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        if ($month) {
            $attendanceQuery->whereMonth('created_at', $month);
        }

        $attendance = $attendanceQuery->paginate(10);

        return view('admin.report', compact('attendance', 'search', 'month'));
    }

    public function dailyReport(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month');

        $attendanceQuery = Attendance::query();

        if ($search) {
            $attendanceQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        if ($month) {
            $attendanceQuery->whereMonth('created_at', $month);
        }

        $attendance = $attendanceQuery->get();

        $csvData = $attendance->map(function ($att) {
            return [
                'Time In' => $att->created_at->format('h:i A'),
                'Name' => $att->first_name . ' ' . $att->last_name,
                'Status' => $att->status,
                'Justification' => $att->justification,
            ];
        });

        $csvHeader = ['Time In', 'Name', 'Status', 'Justification'];
        $filename = 'attendance_report-' . now()->format('Y-m-d') . '.csv';

        return response()->stream(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function monthlyReport(Request $request)
{
    $search = $request->input('search');
    $month = $request->input('month');

    // Query to filter attendance based on search and month
    $filteredAttendanceQuery = Attendance::query();

    if ($search) {
        $filteredAttendanceQuery->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    }

    if ($month) {
        $filteredAttendanceQuery->whereMonth('created_at', $month);
    }

    // Get the filtered results
    $filteredAttendance = $filteredAttendanceQuery->get();

    // Pass the data to the view
    return view('admin.report', compact('filteredAttendance', 'search', 'month'));
}

}

