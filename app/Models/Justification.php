<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    public $timestamps = false;

    public $fillable = [
        'instructor_id',
        'schedule_id',
        'justification',
        'absent_date',
        'current_date',
    ];
}
