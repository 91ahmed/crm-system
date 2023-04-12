<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Lead;
use App\Models\Note;
use App\Models\Replay;
use App\Models\Activity;
use DB;

class LeadController extends Controller
{
    public function index (Request $request)
    {   
        $AllLeads = Lead::orderBy('lead_id', 'DESC')->with('user', 'status', 'country')->paginate(20);

        return view('leads/lead', compact('AllLeads'));
    } 

	public function add (Request $request)
	{
        $id = Lead::max('lead_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'lead_email' => ['required', 'string', 'email', 'max:80','unique:leads'],
    		'lead_first_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
    		'lead_last_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
    		'lead_full_name' => ['required', 'string', 'max:100', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
    		'lead_company' => ['nullable', 'numeric'],
    		'lead_gender' => ['required', 'numeric'],
    		'lead_status' => ['required', 'numeric'],
            'lead_source' => ['nullable', 'numeric'],
    		'lead_assigned_to' => ['required', 'numeric'],
    		'lead_website' => ['nullable', 'string'],
    		'lead_phone' => ['nullable', 'numeric'],
    		'lead_fax' => ['nullable', 'numeric'],
    		'lead_address' => ['nullable', 'string'],
    		'lead_city' => ['nullable', 'string'],
    		'lead_region' => ['nullable', 'string'],
    		'lead_country' => ['required', 'numeric'],
    		'lead_birth_day' => ['nullable', 'numeric'],
    		'lead_birth_month' => ['nullable', 'numeric'],
    		'lead_birth_year' => ['nullable', 'numeric'],
    		'lead_postal_code' => ['nullable', 'numeric'],
    		'lead_details' => ['nullable', 'string'],
            'lead_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
    	]);

        // Upload Image
        $leadImage = null;

        if($request->hasFile('lead_image')) 
        {
            $file      = $request->file('lead_image');
            $filePath  = public_path().'/uploads/images/leads/';
            $leadImage = md5(microtime()).'.'.$file->extension();
            $file->move($filePath, $leadImage);
        }

    	// Insert Date
    	$lead = new Lead;
        $lead->lead_id = $id;
    	$lead->lead_email = $request->input('lead_email');
    	$lead->lead_first_name = $request->input('lead_first_name');
    	$lead->lead_last_name = $request->input('lead_last_name');
    	$lead->lead_full_name = $request->input('lead_full_name');
    	$lead->lead_company = $request->input('lead_company');
    	$lead->lead_gender = $request->input('lead_gender');
    	$lead->lead_status = $request->input('lead_status');
        $lead->lead_source = $request->input('lead_source');
    	$lead->lead_website = $request->input('lead_website');
    	$lead->lead_phone = $request->input('lead_phone');
    	$lead->lead_fax = $request->input('lead_fax');
    	$lead->lead_address = $request->input('lead_address');
    	$lead->lead_city = $request->input('lead_city');
    	$lead->lead_region = $request->input('lead_region');
    	$lead->lead_country = $request->input('lead_country');
    	$lead->lead_birth_day = $request->input('lead_birth_day');
    	$lead->lead_birth_month = $request->input('lead_birth_month');
    	$lead->lead_birth_year = $request->input('lead_birth_year');
    	$lead->lead_postal_code = $request->input('lead_postal_code');
    	$lead->lead_assigned_to = $request->input('lead_assigned_to');
    	$lead->lead_details = $request->input('lead_details');
        $lead->lead_image = $leadImage;
    	$lead->save();

        session()->flash('save', 'Your data has been saved successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
	}

    public function delete (Request $request)
    {
        $allleads = $request->input('lead_id');

        // Delete user image from directory
        foreach ($allleads as $lead) {
            $leadImage = Lead::select('lead_image')->where('lead_id', '=', $lead)->get();

            foreach ($leadImage as $image) {
                $leadImagePath = public_path().'/uploads/images/leads/'.$image->lead_image;
                if (is_file($leadImagePath)){
                    unlink($leadImagePath);
                }
            }
        }

        // Delete user from database
        Lead::destroy($allleads);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
           return redirect('leads');
        }
    }

    public function updatePage ($id)
    {  
        $AllLeads = Lead::with('company', 'country', 'user', 'gender', 'status', 'source')
                     ->where('lead_id', '=', $id)
                     ->get();

        return view('leads/update', compact('AllLeads'));
    }

    public function update (Request $request)
    {
        $leadId = $request->input('lead_id');

        // Validation
        $validatedData = $request->validate([
            'lead_email' => ['required', 'string', 'email', 'max:80'],
            'lead_first_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
            'lead_last_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
            'lead_full_name' => ['required', 'string', 'max:100', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
            'lead_company' => ['nullable', 'numeric'],
            'lead_gender' => ['required', 'numeric'],
            'lead_status' => ['required', 'numeric'],
            'lead_source' => ['nullable', 'numeric'],
            'lead_assigned_to' => ['required', 'numeric'],
            'lead_website' => ['nullable', 'string'],
            'lead_phone' => ['nullable', 'numeric'],
            'lead_fax' => ['nullable', 'numeric'],
            'lead_address' => ['nullable', 'string'],
            'lead_city' => ['nullable', 'string'],
            'lead_region' => ['nullable', 'string'],
            'lead_country' => ['required', 'numeric'],
            'lead_birth_day' => ['nullable', 'numeric'],
            'lead_birth_month' => ['nullable', 'numeric'],
            'lead_birth_year' => ['nullable', 'numeric'],
            'lead_postal_code' => ['nullable', 'numeric'],
            'lead_details' => ['nullable', 'string'],
            'lead_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);

        // Get old image
        $leadImage     = $request->input('lead_old_image');
        $leadImagePath = public_path().'/uploads/images/leads/';

        if ($request->hasFile('lead_image')) {
            // Delete old image if it exsits
            if (is_file($leadImagePath.$leadImage)) {
                unlink($leadImagePath.$leadImage);
            }

            // Upload new image
            $leadNewImage = $request->file('lead_image');
            $leadImage = md5(microtime()).'.'.$leadNewImage->extension();
            $leadNewImage->move($leadImagePath, $leadImage);
        }

        // Update Date
        $lead = Lead::where('lead_id', $leadId)->first();
        $lead->lead_email = $request->input('lead_email');
        $lead->lead_first_name = $request->input('lead_first_name');
        $lead->lead_last_name = $request->input('lead_last_name');
        $lead->lead_full_name = $request->input('lead_full_name');
        $lead->lead_company = $request->input('lead_company');
        $lead->lead_gender = $request->input('lead_gender');
        $lead->lead_status = $request->input('lead_status');
        $lead->lead_source = $request->input('lead_source');
        $lead->lead_website = $request->input('lead_website');
        $lead->lead_phone = $request->input('lead_phone');
        $lead->lead_fax = $request->input('lead_fax');
        $lead->lead_address = $request->input('lead_address');
        $lead->lead_city = $request->input('lead_city');
        $lead->lead_region = $request->input('lead_region');
        $lead->lead_country = $request->input('lead_country');
        $lead->lead_birth_day = $request->input('lead_birth_day');
        $lead->lead_birth_month = $request->input('lead_birth_month');
        $lead->lead_birth_year = $request->input('lead_birth_year');
        $lead->lead_postal_code = $request->input('lead_postal_code');
        $lead->lead_assigned_to = $request->input('lead_assigned_to');
        $lead->lead_details = $request->input('lead_details');
        $lead->lead_image = $leadImage;
        $lead->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function profile ($id)
    {
        $lead  = Lead::with('company', 'country', 'user', 'gender', 'status', 'source')
                     ->where('lead_id', '=', $id)
                     ->first();

        $notes = Note::with('user', 'lead')
        			 ->orderBy('note_id', 'DESC')
        			 ->where('note_lead_id', '=', $id)
        			 ->paginate(20);

        $leadActivities = Activity::with('user', 'lead', 'activityStatus', 'activityTarget', 'activityType')
                                  ->orderBy('activity_id', 'DESC')
                                  ->where('activity_lead', '=', $id)
                                  ->get();

        return view('leads/profile', compact('lead', 'notes', 'leadActivities'));
    }

    public function addNote (Request $request)
    {
    	// Validation
        $validatedData = $request->validate([
        	'note_content' => ['required', 'string'],
        	'note_user_id' => ['required', 'numeric'],
        	'note_lead_id' => ['required', 'numeric'],
        ]);

        $note = new Note;
        $note->note_user_id = $request->input('note_user_id');
        $note->note_lead_id = $request->input('note_lead_id');
        $note->note_content = $request->input('note_content');
        $note->save();

        session()->flash('save', 'Your data has been saved successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function updateNote (Request $request)
    {
    	// Validation
        $validatedData = $request->validate([
        	'note_content' => ['required', 'string'],
        	'note_user_id' => ['required', 'numeric'],
        	'note_lead_id' => ['required', 'numeric'],
        	'note_id'      => ['required', 'numeric'],
        ]);

        // Store inputs data in variables
    	$note_lead_id = $request->input('note_lead_id');
    	$note_user_id = $request->input('note_user_id');
    	$note_content = $request->input('note_content');
    	$note_id      = $request->input('note_id');

    	// Update request
        $note = Note::where('note_user_id', '=', $note_user_id)
        			->where('note_lead_id', '=', $note_lead_id)
        			->where('note_id', '=', $note_id)
        		    ->first();
        $note->note_content = $note_content;
        $note->save();

        session()->flash('updated', 'Your data has been updated successfuly.');

        // Redirect back
        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function deleteNote (Request $request)
    {
    	// Validation
        $validatedData = $request->validate([
        	'note_user_id' => ['required', 'numeric'],
        	'note_lead_id' => ['required', 'numeric'],
        	'note_id'      => ['required', 'numeric'],
        ]);

        // Store inputs data in variables
    	$note_lead_id = $request->input('note_lead_id');
    	$note_user_id = $request->input('note_user_id');
    	$note_id      = $request->input('note_id');

        // Delete request
        $note = Note::where('note_lead_id', '=', $note_lead_id)
        			->where('note_user_id', '=', $note_user_id)
        			->where('note_id', '=', $note_id);
		$note->delete();

        session()->flash('delete', 'Your data has been deleted successfuly.');

        // Redirect back
        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function addReplay (Request $request)
    {
    	// Validation
        $validatedData = $request->validate([
        	'replay_content' => ['required', 'string'],
        	'replay_user_id' => ['required', 'numeric'],
        	'replay_note_id' => ['required', 'numeric'],
        ]);

        $replay = new Replay;
        $replay->replay_note_id = $request->input('replay_note_id');
        $replay->replay_user_id = $request->input('replay_user_id');
        $replay->replay_content = $request->input('replay_content');
        $replay->save();

        session()->flash('save', 'Your data has been saved successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function updateStatus ()
    {
        // Validation
        $validatedData = $request->validate([
            'lead_status' => ['required', 'numeric'],
        ]);

        // Store inputs data in variables
        $lead_status  = $request->input('lead_status');
        $lead_id      = $request->input('lead_id');

        // Update request
        $lead = Lead::where('lead_id', '=', $lead_id)->first();
        $lead->lead_status = $lead_status;
        $lead->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        // Redirect back
        if(!$request->ajax()){
            return redirect()->back();
        }
    }
}
