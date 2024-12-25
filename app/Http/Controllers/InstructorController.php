<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class InstructorController extends Controller
{
    public function showByLetter($alpha)
    {
        return view('user.letter')->with("alpha",$alpha);
    }
}
