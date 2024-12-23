<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'Date',
        'Day',
        'Time',
        'Subject_Code',
        'Room',
        'Instructor_id'
    ];
}
