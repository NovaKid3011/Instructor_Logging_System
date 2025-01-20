<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LoggerController extends Controller
{
    public function index(){
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY'),
            'Origin' => 'https://instructor-logging.webactivities.online'
        ])->get('https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100');

        if ($response->successful()) {
            $data = $response->json()['data'] ?? [];

            $selectedId = DB::table('instructors')->pluck('employee_id')->toArray();

            foreach($data as &$item) {
                $item['selected'] = in_array($item['id'], $selectedId);
            }

            return view('admin.loggers', ['data' => $data]);
        } else {
            return view('admin.loggers')->with('error', 'cannot fetch data');
        }
    }

    public function selection(Request $request) {
        $selectedId = $request->input('selected_ids', []);

        $existing = DB::table('instructors')->pluck('employee_id')->toArray();

        $add = array_diff($selectedId, $existing);
        $remove = array_diff($existing, $selectedId);

        foreach($add as $addId) {
            DB::table('instructors')->insert([
                'employee_id' => $addId,
            ]);
        }

        DB::table('instructors')->whereIn('employee_id', $remove)->delete();

        return response()->json(['message' => 'Saved successfully']);
    }

}
