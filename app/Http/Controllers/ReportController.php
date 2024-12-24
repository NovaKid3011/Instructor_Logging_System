<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index ()
    {
        // via API
        return view("admin.report");
        
    }

    public function getDailyReport()
    {
        $data = [
            [
                'time_in' => '07:30 AM',
                'name' => 'MR. MARK JOSEPH C. GIGANTE',
                'subject_code' => 'IT ELEC 102',
                'description' => 'Example Description',
                'schedule' => '07:30 AM - 09:00 PM',
                'room' => '103',
            ],
            // Add more mock data as needed
        ];

        return response()->json($data);
    }

    public function getMonthlyReport()
    {
        $data = [
            [
                'date' => '2',
                'day' => 'MON',
                'time' => '1:00-2:30',
                'subject_code' => 'GEN. ED. 102',
                'room' => '101',
                'arrival_time' => '01:00',
                'status' => 'Present',
            ],
            [
                'date' => '2',
                'day' => 'MON',
                'time' => '2:30-4:00',
                'subject_code' => 'GEN. ED. 102',
                'room' => '101',
                'arrival_time' => '02:23',
                'status' => 'Present',
            ],
        ];

        return response()->json($data);
    }

}