<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Lead;
use App\Models\Activity;
use App\Models\UserPermission;
use DB;

class UserController extends Controller
{
    public function index ()
    {   
        $allUsers = User::orderBy('user_id', 'DESC')->with('role')->get();

        return view('users/user', compact('allUsers'));
    }

    public function add (Request $request)
    {
        // User id
        $id = User::max('user_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'email' => ['required', 'string', 'email', 'max:80','unique:users'],
    		'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed'],
    		'user_first_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
    		'user_last_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
    		'user_full_name' => ['required', 'string', 'max:100', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
    		'user_gender' => ['required', 'numeric'],
    		'user_role' => ['required', 'numeric'],
    		'user_website' => ['nullable', 'string'],
    		'user_phone' => ['nullable', 'numeric'],
    		'user_fax' => ['nullable', 'numeric'],
    		'user_address' => ['nullable', 'string'],
    		'user_city' => ['nullable', 'string'],
    		'user_region' => ['nullable', 'string'],
    		'user_country' => ['required', 'numeric'],
    		'user_birth_day' => ['nullable', 'numeric'],
    		'user_birth_month' => ['nullable', 'numeric'],
    		'user_birth_year' => ['nullable', 'numeric'],
    		'user_postal_code' => ['nullable', 'numeric'],
    		'user_details' => ['nullable', 'string'],
    		'user_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
    	]);

        // Upload Image
        $userImage = null;

        if($request->hasFile('user_image')) 
        {
            $file      = $request->file('user_image');
            $filePath  = public_path().'/uploads/images/users/';
            $userImage = md5(microtime()).'.'.$file->extension();
            $file->move($filePath, $userImage);
        }

    	// Insert Date
    	$user = new User;
        $user->user_id = $id;
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->user_first_name = $request->input('user_first_name');
    	$user->user_last_name = $request->input('user_last_name');
    	$user->user_full_name = $request->input('user_full_name');
    	$user->user_gender = $request->input('user_gender');
    	$user->user_role = $request->input('user_role');
    	$user->user_website = $request->input('user_website');
    	$user->user_phone = $request->input('user_phone');
    	$user->user_fax = $request->input('user_fax');
    	$user->user_address = $request->input('user_address');
    	$user->user_city = $request->input('user_city');
    	$user->user_region = $request->input('user_region');
    	$user->user_country = $request->input('user_country');
    	$user->user_birth_day = $request->input('user_birth_day');
    	$user->user_birth_month = $request->input('user_birth_month');
    	$user->user_birth_year = $request->input('user_birth_year');
    	$user->user_postal_code = $request->input('user_postal_code');
    	$user->user_details = $request->input('user_details');
    	$user->user_image = $userImage;
    	$user->save();

        // Insert permission
        if(!empty($request->input('permission'))){
            $permission = $request->input('permission');
            if(is_array($permission) || is_object($permission)){
                foreach($permission as $pr){
                    DB::table('user_permission')->insert(array(
                        array("permission_id"=>$pr, "user_id"=>$id),
                    ));
                }
            }
        }

        session()->flash('save', 'Your data has been saved successfuly.');

    	if(!$request->ajax()){
    		return redirect()->back();
    	}
    }

    public function delete (Request $request)
    {
        $allUsers = $request->input('user_id');

        // Delete user image from directory
        foreach ($allUsers as $user) {
            $userImage = User::select('user_image')->where('user_id', '=', $user)->get();

            foreach ($userImage as $image) {
                $userImagePath = public_path().'/uploads/images/users/'.$image->user_image;
                if (is_file($userImagePath)){
                    unlink($userImagePath);
                }
            }
        }

        // Delete user from database
        User::destroy($allUsers);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('users');
        }
    }

    public function updatePage ($id)
    {  
        $allUsers = User::with('country', 'role', 'gender', 'permission')
                     ->where('user_id', '=', $id)
                     ->get();

        return view('users/update', compact('allUsers'));
    }

    public function update (Request $request)
    {
        $id = $request->input('user_id');

        // Validation
        $validatedData = $request->validate([
            'user_first_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
            'user_last_name' => ['required', 'string', 'max:20', 'min:2', 'regex:~^[a-z\-\'\p{Arabic}]{1,60}$~iu'],
            'user_full_name' => ['required', 'string', 'max:100', 'regex:/^(?!.*\d)[a-z\p{Arabic}\s]+$/iu'],
            'user_gender' => ['required', 'numeric'],
            'user_role' => ['required', 'numeric'],
            'user_website' => ['nullable', 'string'],
            'user_phone' => ['nullable', 'numeric'],
            'user_fax' => ['nullable', 'numeric'],
            'user_address' => ['nullable', 'string'],
            'user_city' => ['nullable', 'string'],
            'user_region' => ['nullable', 'string'],
            'user_country' => ['required', 'numeric'],
            'user_birth_day' => ['nullable', 'numeric'],
            'user_birth_month' => ['nullable', 'numeric'],
            'user_birth_year' => ['nullable', 'numeric'],
            'user_postal_code' => ['nullable', 'numeric'],
            'user_details' => ['nullable', 'string'],
            'user_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);

        // Get old image
        $userImage     = $request->input('user_old_image');
        $userImagePath = public_path().'/uploads/images/users/';

        if ($request->hasFile('user_image')) {
            // Delete old image if it exsits
            if (is_file($userImagePath.$userImage)) {
                unlink($userImagePath.$userImage);
            }

            // Upload new image
            $userNewImage = $request->file('user_image');
            $userImage = md5(microtime()).'.'.$userNewImage->extension();
            $userNewImage->move($userImagePath, $userImage);
        }

        // Update Date
        $user = User::where('user_id', $id)->first();
        $user->user_first_name = $request->input('user_first_name');
        $user->user_last_name = $request->input('user_last_name');
        $user->user_full_name = $request->input('user_full_name');
        $user->user_gender = $request->input('user_gender');
        $user->user_role = $request->input('user_role');
        $user->user_website = $request->input('user_website');
        $user->user_phone = $request->input('user_phone');
        $user->user_fax = $request->input('user_fax');
        $user->user_address = $request->input('user_address');
        $user->user_city = $request->input('user_city');
        $user->user_region = $request->input('user_region');
        $user->user_country = $request->input('user_country');
        $user->user_birth_day = $request->input('user_birth_day');
        $user->user_birth_month = $request->input('user_birth_month');
        $user->user_birth_year = $request->input('user_birth_year');
        $user->user_postal_code = $request->input('user_postal_code');
        $user->user_details = $request->input('user_details');
        $user->user_image = $userImage;
        $user->save();

        // Update permissions
        UserPermission::where('user_id', '=', $id)->delete();
        if(!empty($request->input('permission'))){
            $permission = $request->input('permission');
            if(is_array($permission) || is_object($permission)){
                foreach($permission as $pr){
                    DB::table('user_permission')->insert(array(
                        array("permission_id"=>$pr, "user_id"=>$id),
                    ));
                }
            }
        }

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function profile ($id)
    {
        $userLeads = Lead::orderBy('lead_id', 'DESC')
                         ->where('lead_assigned_to', '=', $id)
                         ->get();

        $userLeadsCount = Lead::where('lead_assigned_to', '=', $id)->count();

        $user  = User::with('gender', 'role', 'country', 'permission')
                     ->where('user_id', '=', $id)
                     ->first();

        $userActivities = Activity::with('user', 'lead', 'activityStatus', 'activityTarget', 'activityType')
                                  ->orderBy('activity_id', 'DESC')
                                  ->where('activity_user', '=', $id)
                                  ->get();

        $userActivitiesCount = Activity::with('user', 'lead', 'activityStatus', 'activityTarget', 'activityType')
                                  ->where('activity_user', '=', $id)
                                  ->count();

        return view('users/profile', compact('user', 'userLeads', 'userActivitiesCount', 'userActivities', 'userLeadsCount'));
    }
}
