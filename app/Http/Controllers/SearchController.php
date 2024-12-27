<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search'); // Retrieve 'search' input
        $month = $request->query('month');  // Retrieve 'month' input

        $attendanceQuery = Attendance::query();

        // Filter by search term
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

        // Execute the query and fetch results
        $attendance = $attendanceQuery->get();

        // Pass results to the view
        return view('admin.report', compact('attendance'));
    }
}
