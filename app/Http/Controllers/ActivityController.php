<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Notifi;

class ActivityController extends Controller
{
    public function index ()
    {
    	$allActivities = Activity::with('user', 'lead', 'activityStatus', 'activityTarget', 'activityType')
    							 ->orderBy('activity_id', 'DESC')
    							 ->get();

        if (isset($_GET['noti_id'])) {
            $noti_id = $_GET['noti_id'];

            $notifi = Notifi::find($noti_id);
            $notifi->notifi_status = 1;
            $notifi->save();
        }

    	return view('activities/activity', compact('allActivities'));
    }

    public function addPage ()
    {
    	return view('activities/add');
    }

    public function add (Request $request)
    {
        $id = Activity::max('activity_id')+1;

        /*
        // Validation
        $validatedData = $request->validate([
            'activity_subject' => ['required', 'string'],
            'activity_details' => ['required', 'string'],
            'activity_lead' => ['required', 'numeric'],
            'activity_user' => ['required', 'numeric'],
            'activity_target' => ['required', 'numeric'],
            'activity_type' => ['required', 'numeric'],
            'activity_status' => ['required', 'numeric'],
            'activity_start_date' => ['required', 'date'],
            'activity_start_time' => ['required', 'date_format:H:i'],
            'activity_due_date' => ['required', 'date'],
        ]);
        */
        $activity = new Activity;
        $activity->activity_id = $id;
        $activity->activity_subject = $request->input('activity_subject');
        $activity->activity_details = $request->input('activity_details');
        $activity->activity_lead = $request->input('activity_lead');
        $activity->activity_user = $request->input('activity_user');
        $activity->activity_target = $request->input('activity_target');
        $activity->activity_type = $request->input('activity_type');
        $activity->activity_status = $request->input('activity_status');
        $activity->activity_start_date = $request->input('activity_start_date');
        $activity->activity_start_time = $request->input('activity_start_time');
        $activity->activity_due_date = $request->input('activity_due_date');
        $activity->save();

        $notifi = new Notifi;
        $notifi->notifi_user = $request->input('activity_user');
        $notifi->notifi_subject = 'added a new activity';
        $notifi->notifi_details = 'click here to view';
        $notifi->notifi_link = 'activities';
        $notifi->notifi_time = date('Y-m-d');
        $notifi->notifi_status = 0;
        $notifi->save();

        /*
        "INSERT INTO notifi (notifi_user, notifi_subject, notifi_details, notifi_link, notifi_time) VALUES (3, 'added a new activity', 'click here to view', 'activities', '2022-12-21');"
        */

        session()->flash('save', 'Your data has been saved successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function updatePage ($id)
    {
		$allActivities = Activity::with('user', 'lead', 'activityStatus', 'activityTarget', 'activityType')
		    					 ->orderBy('activity_id', 'DESC')
		    					 ->where('activity_id', '=', $id)
		    					 ->get();

    	return view('activities/update', compact('allActivities'));
    }

    public function update (Request $request)
    {
    	$activityId = $request->input('activity_id');

    	// Validation
    	$validatedData = $request->validate([
    		'activity_subject' => ['required', 'string'],
    		'activity_details' => ['required', 'string'],
    		'activity_lead' => ['required', 'numeric'],
            'activity_user' => ['required', 'numeric'],
    		'activity_target' => ['required', 'numeric'],
    		'activity_type' => ['required', 'numeric'],
    		'activity_status' => ['required', 'numeric'],
    		'activity_start_date' => ['required', 'date'],
    		'activity_start_time' => ['required', 'date_format:H:i:s'],
    		'activity_due_date' => ['required', 'date'],
    	]);

    	// Update
    	$activity = Activity::where('activity_id', $activityId)->first();
    	$activity->activity_subject = $request->input('activity_subject');
    	$activity->activity_details = $request->input('activity_details');
    	$activity->activity_lead = $request->input('activity_lead');
    	$activity->activity_user = $request->input('activity_user');
    	$activity->activity_target = $request->input('activity_target');
    	$activity->activity_type = $request->input('activity_type');
    	$activity->activity_status = $request->input('activity_status');
    	$activity->activity_start_date = $request->input('activity_start_date');
    	$activity->activity_start_time = $request->input('activity_start_time');
    	$activity->activity_due_date = $request->input('activity_due_date');
    	$activity->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function delete (Request $request)
    {
        $activities = $request->input('activity_id');

        // Delete activities from database
        Activity::destroy($activities);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('activities');
        }
    }
}
