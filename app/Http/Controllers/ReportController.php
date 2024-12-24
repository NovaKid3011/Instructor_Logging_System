<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dailyReport()
    {
        // via API
        return view("admin.reports.daily");
        
    }

    public function monthlyReport()
    {
        return view("admin.reports.monthly");
    }

    public function customReport(Request $request)
    {
        return view("admin.reports.custom");
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        // via API
    }

    // Show Edit Form
    public function edit($id)
    {
        // via API
    }

    public function update(Request $request, $id)
    {
        // via API

    }

    public function destroy($id)
    {
        // via API
    }
}
