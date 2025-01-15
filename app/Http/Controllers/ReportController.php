<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    $attendances = $attendanceQuery->paginate(10);

    $hasTodayData = Attendance::whereDate('created_at', now()->toDateString())->exists();

    return view('admin.report', compact('attendances', 'search', 'month', 'hasTodayData'));
}

public function printDaily(Request $request)
    {
        $search = $request->input('search');
        $attendances = Attendance::query();

        if ($search) {
            $attendances->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        $attendances = $attendances->whereDate('created_at', now())->get();

        return view('admin.print-daily', compact('attendances'));
    }

    public function pdfDaily(Request $request)
    {
        $search = $request->input('search');
        $attendances = Attendance::query();

        if ($search) {
            $attendances->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        $attendances = $attendances->whereDate('created_at', now())->get();

        $pdf = PDF::loadView('admin.pdf-daily', compact('attendances'));

        $fileName = 'Daily_report_' . now()->format('m-d-Y') . '.pdf';

        return $pdf->download($fileName);
    }


    public function dailyReport(Request $request)
{
    $search = $request->input('search');
    $attendances = Attendance::query();

    if ($search) {
        $attendances->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    }

    $attendances = $attendances->whereDate('created_at', now())->get();

    $fileName = 'Daily_report_' . now()->format('m-d-Y') . '.csv';

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

public function monthlyReport(Request $request)
{
    $month = $request->input('month');
    $search = $request->input('search');
    $attendances = Attendance::query();

    if ($month) {
        $attendances->whereMonth('created_at', $month);
    }

    if ($search) {
        $attendances->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    }

    $attendances = $attendances->get();

    $monthName = now()->month($month)->format('F'); // Convert month number to full name (e.g., "December")
    $fileName = 'Attendance_report_' . strtolower($monthName) . '-' . now()->year . '.csv';

    return response()->stream(function () use ($attendances) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Date', 'Day', 'Name', 'Subject Code', 'Description', 'Schedule', 'Room', 'Justification']);

        foreach ($attendances as $attendance) {
            fputcsv($file, [
                $attendance->created_at->format('Y-m-d'),
                $attendance->created_at->format('l'),
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


    }

