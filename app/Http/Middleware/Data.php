<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\Status;
use App\Models\Country;
use App\Models\User;
use App\Models\Lead;
use App\Models\Role;
use App\Models\Source;
use App\Models\Company;
use App\Models\Permission;
use App\Models\ActivityStatus;
use App\Models\ActivityTarget;
use App\Models\ActivityType;
use App\Models\Notifi;

class Data
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \View::share('products', Product::all());
        \View::share('genders', Gender::all());
        \View::share('status', Status::all());
        \View::share('countries', Country::all());
        \View::share('users', User::all());
        \View::share('leads', Lead::all());
        \View::share('roles', Role::all());
        \View::share('sources', Source::all());
        \View::share('companies', Company::all());
        \View::share('permissions', Permission::all());
        \View::share('activityStatus', ActivityStatus::all());
        \View::share('activityTarget', ActivityTarget::all());
        \View::share('activityType', ActivityType::all());
        \View::share('notifies', Notifi::with('user')->orderBy('notifi_id', 'desc')->limit(50)->get());

        // New Leads according to last week
        //\View::share('newLeads', );

        // New Orders according to last month
        //\View::share('newOrders', );

        // Monthly Revenu
        //\View::share('revenu', Status::all());

        // 
        //\View::share('status', Status::all());

        return $next($request);
    }
}
