<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

$today = Carbon::today()->toDateString();

$hasTodayData = $attendances->where('date', $today)->isNotEmpty();
