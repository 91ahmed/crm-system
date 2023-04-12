<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\Lead;

class CompanyController extends Controller
{
    public function index (Request $request)
    {   
        $allCompanies = Company::orderBy('company_id', 'DESC')->get();

        return view('companies/company', compact('allCompanies'));
    }

    public function add (Request $request)
    {
        $id = Company::max('company_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'company_email' => ['required', 'string', 'email', 'max:80'],
    		'company_name' => ['required', 'string', 'max:150', 'min:2', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
    		'company_website' => ['nullable', 'string'],
    		'company_industry' => ['nullable', 'string'],
    		'company_phone' => ['nullable', 'numeric'],
    		'company_fax' => ['nullable', 'numeric'],
    		'company_address' => ['nullable', 'string'],
    		'company_city' => ['nullable', 'string'],
    		'company_region' => ['nullable', 'string'],
    		'company_country' => ['required', 'numeric'],
    		'company_postal_code' => ['nullable', 'numeric'],
    		'company_details' => ['nullable', 'string'],
    	]);

    	// Insert Date
    	$company = new Company;
        $company->company_id = $id;
    	$company->company_email = $request->input('company_email');
    	$company->company_name = $request->input('company_name');
    	$company->company_website = $request->input('company_website');
    	$company->company_industry = $request->input('company_industry');
    	$company->company_phone = $request->input('company_phone');
    	$company->company_fax = $request->input('company_fax');
    	$company->company_address = $request->input('company_address');
    	$company->company_city = $request->input('company_city');
    	$company->company_region = $request->input('company_region');
    	$company->company_country = $request->input('company_country');
    	$company->company_postal_code = $request->input('company_postal_code');
    	$company->company_details = $request->input('company_details');
    	$company->save();

        session()->flash('save', 'Your data has been saved successfuly.');

    	if(!$request->ajax()){
    		return redirect()->back();
    	}
    }

    public function delete (Request $request)
    {
        $companies = $request->input('company_id');

        // Delete company from database
        Company::destroy($companies);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('companies');
        }
    }

    public function updatePage ($id)
    {  
        $companies = Company::with('country')
                     ->where('company_id', '=', $id)
                     ->get();

        $countries = Country::all();

        return view('companies/update', compact('companies', 'countries'));
    }

    public function update (Request $request)
    {
        $companyId = $request->input('company_id');

        // Validation
        $validatedData = $request->validate([
    		'company_email' => ['required', 'string', 'email', 'max:80'],
    		'company_name' => ['required', 'string', 'max:150', 'min:2', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
    		'company_website' => ['nullable', 'string'],
    		'company_industry' => ['nullable', 'string'],
    		'company_phone' => ['nullable', 'numeric'],
    		'company_fax' => ['nullable', 'numeric'],
    		'company_address' => ['nullable', 'string'],
    		'company_city' => ['nullable', 'string'],
    		'company_region' => ['nullable', 'string'],
    		'company_country' => ['required', 'numeric'],
    		'company_postal_code' => ['nullable', 'numeric'],
    		'company_details' => ['nullable', 'string'],
        ]);

        // Update Date
        $company = Company::where('company_id', $companyId)->first();
        $company->company_email = $request->input('company_email');
        $company->company_name = $request->input('company_name');
        $company->company_website = $request->input('company_website');
        $company->company_industry = $request->input('company_industry');
        $company->company_phone = $request->input('company_phone');
        $company->company_fax = $request->input('company_fax');
        $company->company_address = $request->input('company_address');
        $company->company_city = $request->input('company_city');
        $company->company_region = $request->input('company_region');
        $company->company_country = $request->input('company_country');
        $company->company_postal_code = $request->input('company_postal_code');
        $company->company_details = $request->input('company_details');
        $company->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function profile ($id)
    {
        $company = Company::with('country')->where('company_id', '=', $id)->first();

        $companyLeads = Lead::where('lead_company', '=', $id)
                            ->orderBy('lead_id', 'DESC')
                            ->get();

        $companyLeadsCount = Lead::where('lead_company', '=', $id)
                             ->count();

        return view('companies/profile', compact('company', 'companyLeads', 'companyLeadsCount'));
    }
}
