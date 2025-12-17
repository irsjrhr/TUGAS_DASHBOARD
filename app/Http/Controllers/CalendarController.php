<?php

namespace App\Http\Controllers;
use App\Models\ActivityType;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $activityTypes = ActivityType::orderBy('name')->get();
        return view('calendar.index', compact('activityTypes'));
    }
}
