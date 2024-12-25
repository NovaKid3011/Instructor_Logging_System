<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Specify the exact table name
    protected $table = 'attendance';

    // Define the fillable attributes
    protected $fillable = [
        'time_in', 'picture', 'first_name', 'last_name',
        'subject_code', 'description', 'schedule', 'room',
        'status', 'remarks',
    ];

}
class Search extends Model
{
    use HasFactory;

    protected $fillable = ['first_name']; // Specify the searchable columns
}
