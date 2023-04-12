@extends('layouts.app')
@section('title', 'Activities')

@section('content')
    
    @include('layouts/header')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                        <li class="breadcrumb-item">Contacts</li>
                        <li class="breadcrumb-item active"
                            aria-current="page">Activities</li>
                    </ol>
                    </div>
                    <h4 class="page-title">Activity <small>({{ $activity->activity_start_date }})</small></h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="card">
            <div class="card-header">
                Subject
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activity_subject }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activity_details }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Date / Time
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activity_start_date.' / '.$activity->activity_start_time }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Due Date
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activity_due_date }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Target
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activityTarget->activity_target_name }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Status
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->activityStatus->activity_status_name }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Assigned to
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->user->user_full_name }}</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Lead
            </div>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-2">
                    <p>{{ $activity->lead->lead_full_name }}</p>
                </blockquote>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ url('profile/lead').'/'.$activity->lead->lead_id }}" class="btn btn-info btn-sm">Go to lead profile</a>
            <a href="{{ url('calendar') }}" class="btn btn-default" data-dismiss="modal">Back</a>
        </div>

    
    @include('layouts/footer')

@endsection