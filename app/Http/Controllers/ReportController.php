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

    public function downloadCsv(Request $request)
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
            'Name' => $att->first_name . ' ' . $att->last_name,
            'Subject Code' => $att->subject_code,
            'Description' => $att->description,
            'Schedule' => $att->schedule,
            'Room' => $att->room,
            'Status' => $att->status,
            'Justification' => $att->justification,
        ];
    });

    $csvHeader = ['Name', 'Subject Code', 'Description', 'Schedule', 'Room', 'Status', 'Justification'];

    $filename = 'attendance_report.csv';

    // Open PHP output stream and write CSV data
    $handle = fopen('php://output', 'w');
    fputcsv($handle, $csvHeader);

    foreach ($csvData as $row) {
        fputcsv($handle, $row);
    }

    fclose($handle);

    return response()->stream(
        function () use ($handle) {
            fclose($handle);
        },
        200,
        [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]
    );
}

}
