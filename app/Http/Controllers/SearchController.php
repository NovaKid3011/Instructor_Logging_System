<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Get search input
        $results = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get(); 
        return view('search.results', compact('results', 'query'));
    }
}
