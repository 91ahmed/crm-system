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
                        <h4 class="page-title">Activities</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="mb-3">
                <div class="row no-gutters">
                    <div class="col-12">
                        <button type="button" class="btn btn-light btn-sm modal-delete" data-toggle="modal" data-target="#modal-delete">
                            <span class="fas fa-trash"></span> Delete
                        </button>
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-activity">
                            <span class="fas fa-plus"></span> Add
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="card card-form">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values="[&quot;js-lists-values-employee-name&quot;]">

                                    <form action="{{ url('delete/activity') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <table class="table mb-0 thead-border-top-0" id="dbtable">
                                        <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 18px;">
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input" id="check_all">
                                                            <label class="custom-control-label" for="check_all"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </th>
                                                    <th>Subject</th>
                                                    <th>User</th>
                                                    <th>Target</th>
                                                    <th>Type</th>
                                                    <th>Due Date</th>
                                                    <th><div style="width: 100px;">Options</div></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th style="width: 18px;"></th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search subject" data-column="1">
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-search" data-column="2">
                                                            <option value="" selected>- select user -</option>
                                                            @foreach($users as $user)
                                                            <option value="{{ $user->user_full_name }}">{{ $user->user_full_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-default" data-column="3">
                                                            <option value="" selected>- select target -</option>
                                                            @foreach($activityTarget as $target)
                                                            <option value="{{ $target->activity_target_name }}">{{ $target->activity_target_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-default" data-column="4">
                                                            <option value="" selected>- select type -</option>
                                                            @foreach($activityType as $type)
                                                            <option value="{{ $type->activity_type_name }}">{{ $type->activity_type_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="date" class="form-control dbcolumn" data-column="5">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allActivities as $activity)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $activity->activity_id }}" name="activity_id[]" value="{{ $activity->activity_id }}">
                                                            <label class="custom-control-label" for="check{{ $activity->activity_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $activity->activity_subject }}
                                                    </td>
                                                    <td>{{ $activity->user->user_full_name }}</td>
                                                    <td>{{ $activity->activityTarget->activity_target_name }}</td>
                                                    <td>
                                                        @if($activity->activity_type == 1)
                                                        <span class="badge badge-danger">
                                                        {{ strtoupper($activity->activityType->activity_type_name) }}
                                                        </span>
                                                        @else
                                                        <span class="badge badge-info">
                                                        {{ strtoupper($activity->activityType->activity_type_name) }}
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $activity->activity_due_date }}</td>
                                                    <td>
                                                        <a href="{{ url('update/activity').'/'.$activity->activity_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
                                                        <i class="fas fa-wrench"></i>
                                                        </a>
                                                        <span data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-preview{{ $activity->activity_id }}"><i class="fas fa-eye"></i></button>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <!-- Modal Preview -->
                                                <div id="modal-preview{{ $activity->activity_id }}" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content bg-default">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="mySmallModalLabel">{{ $activity->activity_subject }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body p-4">
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
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div> <!-- // END .modal-body -->
                                                        </div> <!-- // END .modal-content -->
                                                    </div> <!-- // END .modal-dialog -->
                                                </div> <!-- // END .modal -->
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Danger Alert Modal -->
                                        <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content bg-light">
                                                    <div class="modal-body text-center p-4">
                                                        <i class="fas fa-exclamation-triangle" style="font-size: 30px;"></i>
                                                        <h4 class="text-white">Warning!</h4>
                                                        <p class="text-white mt-3">Are you sure you want to delete this data permanently?</p>
                                                        <button type="submit"
                                                                class="btn btn-dark my-2"
                                                                >Yes, continue</button>
                                                        <button type="button" class="btn btn-dark my-2" data-dismiss="modal">Cancel</button>
                                                    </div> <!-- // END .modal-body -->
                                                </div> <!-- // END .modal-content -->
                                            </div> <!-- // END .modal-dialog -->
                                        </div> <!-- // END .modal -->

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Activity -->
            <div id="modal-activity" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Activity</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <form action="{{ url('add/activity/request') }}" method="POST" enctype="multipart/form-data" class="ajax-form" data-redirect="{{ url('activities') }}" style="width: 100%; text-align: left !important;">
                                @csrf
                                <div class="card card-form">
                                    <div class="row">
                                        <div class="col-12 card-form__body card-body"> 
                                            <div class="row">               
                                                <div class="form-group col-sm-6">
                                                    <label for="activity_type">Type:</label>
                                                    <select class="form-control selectpicker-default" name="activity_type" id="activity_type">
                                                        <option value="" selected="">- select -</option>
                                                        @foreach($activityType as $type)
                                                        <option value="{{ $type->activity_type_id }}">{{ $type->activity_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="activity_target">Target:</label>
                                                    <select class="form-control selectpicker-default" name="activity_target" id="activity_target">
                                                        <option value="" selected="">- select -</option>
                                                        @foreach($activityTarget as $target)
                                                        <option value="{{ $target->activity_target_id }}">{{ $target->activity_target_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="activity_status">Status:</label>
                                                    <select class="form-control selectpicker-default" name="activity_status" id="activity_status">
                                                        <option value="" selected="">- select -</option>
                                                        @foreach($activityStatus as $st)
                                                        <option value="{{ $st->activity_status_id }}">{{ $st->activity_status_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="activity_lead">Lead:</label>
                                                    <select class="form-control selectpicker-search" name="activity_lead" id="activity_lead">
                                                        <option value="" selected="">- select -</option>
                                                        @foreach($leads as $lead)
                                                        <option value="{{ $lead->lead_id }}">{{ $lead->lead_id }} - {{ $lead->lead_full_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Subject</label>
                                                    <input type="text" class="form-control @error('activity_subject') is-invalid @enderror" id="activity_subject" name="activity_subject" value="{{ old('activity_subject') }}" placeholder="subject">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Details</label>
                                                    <textarea class="form-control @error('activity_details') is-invalid @enderror" id="activity_details" name="activity_details" value="{{ old('activity_details') }}" rows="5" placeholder="details"></textarea>
                                                </div>
                                                <div class="form-group col-sm-4 col-6">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="activity_start_date" name="activity_start_date" value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="form-group col-sm-4 col-6">
                                                    <label>Start Time</label>
                                                    <input type="time" class="form-control" id="activity_start_time" name="activity_start_time">
                                                </div>
                                                <div class="form-group col-sm-4 col-12">
                                                    <label>Due Date</label>
                                                    <input type="date" class="form-control" id="activity_due_date" name="activity_due_date">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="activity_user">Assigned to:</label>
                                                    <select class="form-control selectpicker-search" name="activity_user" id="activity_user">
                                                        <option value="{{ auth::user()->user_id }}" selected="">- {{ auth::user()->user_full_name }} -</option>
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
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- // END .modal-body -->
                    </div> <!-- // END .modal-content -->
                </div> <!-- // END .modal-dialog -->
            </div> <!-- // END .modal -->
    
    @include('layouts/footer')

@endsection