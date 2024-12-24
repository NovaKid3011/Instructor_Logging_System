<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $attendance = Attendance::all(); // Replace with API logic if needed
        
        // Pass data to the view
        return view("admin.report", compact('attendance'));
    }
}
