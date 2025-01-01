<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_in',
        'first_name',
        'last_name',
        'subject_code',
        'description',
        'schedule',
        'room',
    ];
}
