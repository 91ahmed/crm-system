<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Activity;

class HomeController extends Controller
{
    public function index ()
    {
    	// Get Leads Count By Status
    	$cold_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'cold')->count();
    	$attempted_to_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'attempted to')->count();
    	$contact_in_future_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'contact in future')->count();
    	$contacted_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'contacted')->count();
    	$hot_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'hot')->count();
    	$junk_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'junk lead')->count();
    	$lost_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'lost lead')->count();
    	$not_contacted_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'not contacted')->count();
    	$pre_qualified_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'pre qualified')->count();
    	$qualified_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'qualified')->count();
    	$warm_lead = Lead::join('status', 'status.status_id', '=', 'leads.lead_status')->where('status_name', '=', 'warm lead')->count();

    	$conference = Lead::join('sources', 'sources.source_id', '=', 'leads.lead_source')->where('source_name', '=', 'conference')->count();
    	$website = Lead::join('sources', 'sources.source_id', '=', 'leads.lead_source')->where('source_name', '=', 'website')->count();
    	$facebook = Lead::join('sources', 'sources.source_id', '=', 'leads.lead_source')->where('source_name', '=', 'facebook')->count();
    	$existing_customer = Lead::join('sources', 'sources.source_id', '=', 'leads.lead_source')->where('source_name', '=', 'existing customer')->count();

        $activity_planned = Activity::join('activities_status', 'activities_status.activity_status_id', '=', 'activities.activity_status')->where('activity_status_name', '=', 'planned')->count();

        $activity_held = Activity::join('activities_status', 'activities_status.activity_status_id', '=', 'activities.activity_status')->where('activity_status_name', '=', 'held')->count();

        $activity_notheld = Activity::join('activities_status', 'activities_status.activity_status_id', '=', 'activities.activity_status')->where('activity_status_name', '=', 'not held')->count();

       $activity_done = Activity::join('activities_status', 'activities_status.activity_status_id', '=', 'activities.activity_status')->where('activity_status_name', '=', 'done')->count();

        $revenue = Order::join('products', 'orders.order_product', '=', 'products.product_id')
                        ->where('order_status', '=', 3)
                        ->sum('products.product_price');

    	return view('home', compact(
    		// Leads By Status
    		'cold_lead',
    		'attempted_to_lead', 
    		'contact_in_future_lead', 
    		'contacted_lead', 
    		'hot_lead', 
    		'junk_lead', 
    		'lost_lead', 
    		'not_contacted_lead', 
    		'pre_qualified_lead', 
    		'qualified_lead', 
    		'warm_lead',

    		// Leads By Source
    		'conference',
    		'website',
    		'facebook',
    		'existing_customer',

            'activity_planned',
            'activity_held',
            'activity_notheld',
            'activity_done',

            // Revenue
            'revenue'
    	));
    }
}
