<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


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

        $attendanceQuery->whereDate('created_at', now()->toDateString());

        $attendances = $attendanceQuery->paginate(10);

        $hasTodayData = $attendances->isNotEmpty();

        return view('admin.report', compact('attendances', 'search', 'month', 'hasTodayData'));
    }

    public function printDaily(Request $request)
    {
        $search = $request->input('search');
    
        $attendanceQuery = Attendance::query();
    
        if ($search) {
            $attendanceQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }
    
        $attendances = $attendanceQuery->whereDate('created_at', now())->get();
    
        if ($attendances->isEmpty()) {
            return redirect()->back()->withErrors('No attendance records found for today.');
        }

        return view('admin.download.print', compact('attendances'));

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
    
        $pdf = Pdf::loadView('admin.download.pdf', compact('attendances'));
        return $pdf->download('MLGCL_Daily_Attendance_Monitoring_' . now()->format('m-d-Y') . '.pdf');
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
    
        $fileName = 'MLGCL_DAILY_ATTENDANCE_MONITORING' . now()->format('m-d-Y') . '.csv';
    
        return response()->stream(function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Time In', 'Name', 'Subject Code', 'Description', 'Schedule', 'Room', 'Justification']);
    
            $attendances->whereDate('created_at', now())->chunk(100, function ($chunk) use ($file) {
                foreach ($chunk as $attendance) {
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
            });
    
            fclose($file);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }

    public function csvByMonth(Request $request)
    {
        $month = $request->input('month');
        $search = $request->input('search');
        $instructorId = $request->input('instructor_id'); 
    
        $attendances = Attendance::query();
        
    
        if ($month) {
            $attendances->whereMonth('created_at', $month);
        }
    
        if ($instructorId) {
            $attendances->where('instructor_id', $instructorId);
        }
    
        if ($search) {
            $attendances->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }
    
        $attendances = $attendances->get();
    
        if ($attendances->isNotEmpty()) {
            $firstAttendance = $attendances->first();
            $instructorName = "{$firstAttendance->first_name} {$firstAttendance->last_name}";
        }
    
        $monthName = now()->month($month)->format('F');
        $fileName = 'MLGCL_MONTHLY_ATTENDANCE_MONITORING_' .$instructorName . '_' .
       $monthName . '-' . now()->year .'.csv';
    
        return response()->stream(function () use ($attendances) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['Date', 'Day', 'Subject Code', 'Description', 'Schedule', 'Room', 'Justification']);
            
            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->created_at->format('Y-m-d'),
                    $attendance->created_at->format('l'),
                    // "{$attendance->first_name} {$attendance->last_name}",
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
    public function pdfByMonth(Request $request)
    {
        $month = $request->input('month');
        $search = $request->input('search');
        $instructorId = $request->input('instructor_id'); // Get instructor_id from request
    
        // Validation check for month
        if (!$month || !is_numeric($month) || $month < 1 || $month > 12) {
            return redirect()->back()->withErrors('Invalid or missing month filter. Please select a valid month.');
        }
    
        // Query setup
        $attendanceQuery = Attendance::query();
    
        if ($instructorId) {
            $attendanceQuery->where('instructor_id', $instructorId);
        }
    
        if ($search) {
            $attendanceQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }
    
        // Filter by selected month and year
        $attendanceQuery->whereMonth('created_at', $month)
                        ->whereYear('created_at', now()->year);
    
        // Fetch attendances
        $attendances = $attendanceQuery->get();
    
        // Error if no attendance records found
        if ($attendances->isEmpty()) {
            return redirect()->back()->withErrors('No attendance records found for the selected month.');
        }
    
        // Formatting month name using Carbon
        $monthName = Carbon::createFromFormat('m', $month)->format('F');
        $fileName = 'MLGCL_MONTHLY_ATTENDANCE_' . strtolower($monthName) . '_' . now()->year . '.pdf';
    
        try {
            // Load PDF view and return response
            $pdf = PDF::loadView('admin.download.pdf-by-month', compact('attendances', 'monthName', 'instructorId'));
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
        }
    }
    
    
public function printByMonth(Request $request)
{
    $instructorId = $request->query('instructor_id');
    $attendances = Attendance::where('instructor_id', $instructorId)
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->get();

    if ($attendances->isEmpty()) {
        return redirect()->back()->withErrors('No records found for this instructor this month.');
    }
    

    $instructor = Attendance::where('instructor_id', $instructorId)->firstOrFail();
    $instructorName = $instructor->first_name . ' ' . $instructor->last_name;

    return view('admin.download.print-by-month', compact('attendances', 'instructorName'));
}

    }

