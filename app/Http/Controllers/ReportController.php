<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class ReportController extends Controller
{
    public function index()
    {
        $attendance = Attendance::all(); 

        return view("admin.report", compact('attendance'));
        // dd($request->all());

    }
    
    
}
