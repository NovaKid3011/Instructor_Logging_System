<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{

    public function index(Request $request){
        $search = $request->input('search');
        $month = $request->input('month');
        $attendanceQuery = Attendance::query();

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
        $attendances = $attendanceQuery->paginate(10);

        return view('admin.report', compact('attendances', 'search', 'month'));
    }


    public function dailyReport(Request $request){

        $search = $request->input('search');
        $attendances = Attendance::query();
        $month = date('m');

        if ($search) {
            $attendances->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }
        try {
            $attendances = $attendances->whereDate('created_at', now())->get();

            if ($attendances->isEmpty()) {
                return redirect(route("report"))->with('error', 'No data available.');
            }

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No records found.');
        }

        if($request->input('download') == 1) {
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
        }elseif($request->input('download') == 2){
            $fileName = 'Attendance_Report_' . $month . '.pdf';
            $dompdf = Pdf::loadView('layout.partials.dailyPdf', compact('attendances'));
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
        }elseif($request->input('download') == 3){
            return view('layout.partials.dailyPrint', compact('attendances'));
        }
    }

    public function monthlyReport(Request $request){
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

            if($request->input('export') == 1){
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
            }elseif($request->input('export') == 2){
                $fileName = 'Attendance_Report_' . $month . '.pdf';
                $dompdf = Pdf::loadView('layout.partials.monthlyPdf', compact('attendances'));
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
            }elseif($request->input('export') == 3) {
                return view('layout.partials.monthlyPrint', compact('attendances'));
            }
    }


}

