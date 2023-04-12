@extends('layouts.app')
@section('title', 'Update Activity')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Activities</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Activity</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($allActivities as $activity)
            <div class="row m-0">
                <form action="{{ url('update/activity/request') }}" class="ajax-form" data-redirect="update" method="POST" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="activity_id" value="{{ $activity->activity_id }}">
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body"> 
                                <div class="row">               
                                    <div class="form-group col-sm-6">
                                        <label for="activity_type">Type:</label>
                                        <select class="form-control selectpicker-default" name="activity_type" id="activity_type">
                                            <option value="{{ $activity->activity_type }}" selected="">- {{ $activity->activityType->activity_type_name }} -</option>
                                            @foreach($activityType as $type)
                                            <option value="{{ $type->activity_type_id }}">{{ $type->activity_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="activity_target">Target:</label>
                                        <select class="form-control selectpicker-default" name="activity_target" id="activity_target">
                                            <option value="{{ $activity->activity_target }}" selected="">- {{ $activity->activityTarget->activity_target_name }} -</option>
                                            @foreach($activityTarget as $target)
                                            <option value="{{ $target->activity_target_id }}">{{ $target->activity_target_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="activity_status">Status:</label>
                                        <select class="form-control selectpicker-default" name="activity_status" id="activity_status">
                                            <option value="{{ $activity->activity_status }}" selected="">- {{ $activity->activityStatus->activity_status_name }} -</option>
                                            @foreach($activityStatus as $st)
                                            <option value="{{ $st->activity_status_id }}">{{ $st->activity_status_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="activity_lead">Lead:</label>
                                        <select class="form-control selectpicker-search" name="activity_lead" id="activity_lead">
                                            <option value="{{ $activity->lead->lead_id }}" selected="">- {{ $activity->lead->lead_full_name }} -</option>
                                            @foreach($leads as $lead)
                                            <option value="{{ $lead->lead_id }}">{{ $lead->lead_id }} - {{ $lead->lead_full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" id="activity_subject" name="activity_subject" value="{{ $activity->activity_subject }}" placeholder="subject">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Details</label>
                                        <textarea class="form-control" id="activity_details" name="activity_details" value="{{ $activity->activity_details }}" rows="5" placeholder="details">{{ $activity->activity_details }}</textarea>
                                    </div>
                                    <div class="form-group col-sm-4 col-6">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" id="activity_start_date" name="activity_start_date" value="{{ $activity->activity_start_date }}">
                                    </div>
                                    <div class="form-group col-sm-4 col-6">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control" id="activity_start_time" name="activity_start_time" value="{{ $activity->activity_start_time }}">
                                    </div>
                                    <div class="form-group col-sm-4 col-12">
                                        <label>Due Date</label>
                                        <input type="date" class="form-control" id="activity_due_date" name="activity_due_date" value="{{ $activity->activity_due_date }}">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="activity_user">Assigned to:</label>
                                        <select class="form-control selectpicker-search" name="activity_user" id="activity_user">
                                            <option value="{{ $activity->user->user_id }}" selected="">- {{ $activity->user->user_full_name }} -</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->user_id }}">{{ $user->user_id }} - {{ $user->user_full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
    
    @include('layouts/footer')

@endsection