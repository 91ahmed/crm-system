<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::middleware(['data', 'auth'])->group(function () 
{
	Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

	// Products
	Route::get('products', [App\Http\Controllers\ProductController::class, 'index']);
	Route::get('profile/product/{id}', [App\Http\Controllers\ProductController::class, 'profile']);
	Route::post('add/product/request', [App\Http\Controllers\ProductController::class, 'add']);
	Route::delete('delete/product', [App\Http\Controllers\ProductController::class, 'delete']);
	Route::get('update/product/{id}', [App\Http\Controllers\ProductController::class, 'updatePage']);
	Route::put('update/product/request', [App\Http\Controllers\ProductController::class, 'update']);

	// Campaigns
	Route::get('campaigns', [App\Http\Controllers\CampaignController::class, 'index']);
	Route::get('profile/campaign/{id}', [App\Http\Controllers\CampaignController::class, 'profile']);
	Route::post('add/campaign/request', [App\Http\Controllers\CampaignController::class, 'add']);
	Route::delete('delete/campaign', [App\Http\Controllers\CampaignController::class, 'delete']);
	Route::get('update/campaign/{id}', [App\Http\Controllers\CampaignController::class, 'updatePage']);
	Route::put('update/campaign/request', [App\Http\Controllers\CampaignController::class, 'update']);

	// Users
	Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
	Route::get('profile/user/{id}', [App\Http\Controllers\UserController::class, 'profile']);
	Route::post('add/user/request', [App\Http\Controllers\UserController::class, 'add']);
	Route::delete('delete/user', [App\Http\Controllers\UserController::class, 'delete']);
	Route::get('update/user/{id}', [App\Http\Controllers\UserController::class, 'updatePage']);
	Route::put('update/user/request', [App\Http\Controllers\UserController::class, 'update']);

	// Leads
	Route::get('leads', [App\Http\Controllers\LeadController::class, 'index']);
	Route::get('profile/lead/{id}', [App\Http\Controllers\LeadController::class, 'profile']);
	Route::post('add/lead/request', [App\Http\Controllers\LeadController::class, 'add']);
	Route::delete('delete/lead', [App\Http\Controllers\LeadController::class, 'delete']);
	Route::get('update/lead/{id}', [App\Http\Controllers\LeadController::class, 'updatePage']);
	Route::put('update/lead/request', [App\Http\Controllers\LeadController::class, 'update']);
	Route::post('add/lead/note', [App\Http\Controllers\LeadController::class, 'addNote']);
	Route::put('update/lead/note', [App\Http\Controllers\LeadController::class, 'updateNote']);
	Route::put('update/lead/status', [App\Http\Controllers\LeadController::class, 'updateStatus']);
	Route::delete('delete/lead/note', [App\Http\Controllers\LeadController::class, 'deleteNote']);
	Route::post('add/lead/replay', [App\Http\Controllers\LeadController::class, 'addReplay']);

	// Company
	Route::get('companies', [App\Http\Controllers\CompanyController::class, 'index']);
	Route::get('profile/company/{id}', [App\Http\Controllers\CompanyController::class, 'profile']);
	Route::post('add/company/request', [App\Http\Controllers\CompanyController::class, 'add']);
	Route::delete('delete/company', [App\Http\Controllers\CompanyController::class, 'delete']);
	Route::get('update/company/{id}', [App\Http\Controllers\CompanyController::class, 'updatePage']);
	Route::put('update/company/request', [App\Http\Controllers\CompanyController::class, 'update']);

	// Order
	Route::get('orders', [App\Http\Controllers\OrdersController::class, 'index']);
	Route::get('sales', [App\Http\Controllers\OrdersController::class, 'sales']);
	Route::post('add/order/request', [App\Http\Controllers\OrdersController::class, 'add']);
	Route::delete('delete/order', [App\Http\Controllers\OrdersController::class, 'delete']);
	Route::get('update/order/{id}', [App\Http\Controllers\OrdersController::class, 'updatePage']);
	Route::put('update/order/request', [App\Http\Controllers\OrdersController::class, 'update']);
	Route::get('invoice/order/{id}', [App\Http\Controllers\OrdersController::class, 'invoice']);
	Route::put('change/order/status', [App\Http\Controllers\OrdersController::class, 'changeOrderStatus']);

	// Activities
	Route::get('activities', [App\Http\Controllers\ActivityController::class, 'index']);
	Route::post('add/activity/request', [App\Http\Controllers\ActivityController::class, 'add']);
	Route::delete('delete/activity', [App\Http\Controllers\ActivityController::class, 'delete']);
	Route::get('update/activity/{id}', [App\Http\Controllers\ActivityController::class, 'updatePage']);
	Route::put('update/activity/request', [App\Http\Controllers\ActivityController::class, 'update']);
	
	// Search
	Route::get('search', [App\Http\Controllers\SearchController::class, 'index']);

	// Calendar
	Route::get('calendar', [App\Http\Controllers\CalendarController::class, 'index']);
	Route::get('calendar/activities', [App\Http\Controllers\CalendarController::class,'getActivities']);
	Route::get('calendar/activity/{id}', [App\Http\Controllers\CalendarController::class, 'getActivityByID']);
});