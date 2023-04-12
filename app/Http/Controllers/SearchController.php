<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Company;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->has('search')) 
    	{
    		$search = '%'.$request->input('search').'%';
    		$table  = $request->input('table');

    		$name = '';
    		$view = '';

            $data = Lead::select('lead_id', 'lead_full_name')
                        ->where('lead_full_name', 'LIKE', $search)
                        ->first();

            if(!empty($data)) {
                $name = $data->lead_full_name;
                $view = 'profile/lead/'.$data->lead_id;
            }

    		return view('search', compact('search', 'table', 'name', 'view'));
    	}
    	else
    	{
    		return redirect()->back();
    	}
    }
}
