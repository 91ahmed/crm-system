<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\User;
use Auth;

class CampaignController extends Controller
{
    public function index (Request $request)
    {   
        $allCampaigns = Campaign::orderBy('campaign_id', 'DESC')->with('user')->get();

        return view('campaigns/campaign', compact('allCampaigns'));
    }

    public function add (Request $request)
    {
        // Campaign id
        $id = Campaign::max('campaign_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'campaign_name' => ['required', 'string'],
    		'campaign_start' => ['required', 'date'],
    		'campaign_end' => ['required', 'date'],
    		'campaign_details' => ['required', 'string'],
    	]);

    	// Insert Date
    	$campaign = new Campaign;
        $campaign->campaign_id = $id;
        $campaign->campaign_name = $request->input('campaign_name');
        $campaign->campaign_start = $request->input('campaign_start');
        $campaign->campaign_end = $request->input('campaign_end');
        $campaign->campaign_details = $request->input('campaign_details');
        $campaign->campaign_assigned_to = auth::user()->user_id;
    	$campaign->save();

    	session()->flash('save', 'Your data has been saved successfuly.');

    	if(!$request->ajax()){
    		return redirect()->back();
    	}
    }

    public function delete (Request $request)
    {
        $allCampaigns = $request->input('campaign_id');

        // Delete product from database
        Campaign::destroy($allCampaigns);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('campaigns');
        }
    }

    public function updatePage ($id)
    {  
        $allCampaigns = Campaign::with('user')
                     ->where('campaign_id', '=', $id)
                     ->get();

        return view('campaigns/update', compact('allCampaigns'));
    }

    public function update (Request $request)
    {
        $id = $request->input('campaign_id');

    	// Validation
    	$validatedData = $request->validate([
    		'campaign_name' => ['required', 'string'],
    		'campaign_start' => ['required', 'date'],
    		'campaign_end' => ['required', 'date'],
    		'campaign_details' => ['required', 'string'],
    	]);

        // Update Date
        $campaign = Campaign::where('campaign_id', $id)->first();
        $campaign->campaign_name = $request->input('campaign_name');
        $campaign->campaign_start = $request->input('campaign_start');
        $campaign->campaign_end = $request->input('campaign_end');
        $campaign->campaign_details = $request->input('campaign_details');
        $campaign->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function profile ($id)
    {
        $campaign  = Campaign::with('user')
                     ->where('campaign_id', '=', $id)
                     ->first();

        return view('campaigns/profile', compact('campaign'));
    }
}
