<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $attendance = Attendance::query()
            ->where('first_name', 'LIKE', "%{$search}%")
            ->orWhere('last_name', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.report', compact('attendance'));
    }
}
