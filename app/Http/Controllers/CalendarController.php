<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Activity;

class CalendarController extends Controller
{
    public function index ()
    {
    	return view('calendar');
    }

    public function getActivities ()
    {
    	$allActivities = Activity::all();

    	return response()
    		   ->json($allActivities)
    		   ->header('Content-Type', 'application/json');
    }

    public function getActivityByID ($id)
    {
    	$activity = Activity::where('activity_id', '=', $id)->first();

    	return view('activities/activity_calendar', compact('activity'));
    }
}
