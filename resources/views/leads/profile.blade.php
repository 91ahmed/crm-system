@extends('layouts.app')
@section('title', 'Lead Profile')

@section('content')
    
    @include('layouts/header')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Lead</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title --> 

                <div class="row">
                    <div class="col-lg-4 col-xl-4">
                        <div class="card-box text-center">
                            @if($lead->lead_image == null)
                            <img src="{{ asset('assets/images/avatar.png') }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @else
                            <img src="{{ asset('uploads/images/leads/').'/'.$lead->lead_image }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @endif

                            <h4 class="mb-0">{{ ucwords($lead->lead_first_name.' '.$lead->lead_last_name) }}</h4>
                            <p class="text-muted">{{ ucwords($lead->status->status_name) }}</p>

                            <a href="{{ url('update/lead/').'/'.$lead->lead_id }}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Edit</a>
                            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light" data-toggle="modal" data-target="#modal-delete">Delete</button>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Website" data-original-title="Website">
                                    <a href="{{ $lead->lead_website }}" target="_blank" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-earth"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Call" data-original-title="Call">
                                    <a href="tel: +{{ $lead->country->country_code.''.$lead->lead_phone }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-phone"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send E-mail" data-original-title="Send E-mail">
                                    <a href="mailto: {{ $lead->email }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-email"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Task" data-original-title="Task">
                                    <a href="#" class="social-list-item border-secondary text-secondary" data-toggle="modal" data-target="#modal-add-task"><i
                                            class="mdi mdi-pencil"></i></a>
                                </li>
                            </ul>

                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase">About Me :</h4>
                                <p class="text-muted font-13 mb-3">
                                    Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type.
                                </p>
                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ ucwords($lead->lead_full_name) }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Status :</strong> <span class="badge badge-info">{{ ucwords($lead->status->status_name) }}</span></p>

                                @if($lead->lead_phone != '')
                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">+ ({{ $lead->country->country_code }}) {{ $lead->lead_phone }}</span></p>
                                @endif

                                @if($lead->lead_fax != '')
                                <p class="text-muted mb-2 font-13"><strong>Fax :</strong><span class="ml-2">{{ $lead->lead_fax }}</span></p>
                                @endif

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $lead->lead_email }}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">
                                    {{ $lead->country->country_name }}

                                    @if($lead->lead_city != '')
                                        , {{ $lead->lead_city }}
                                    @endif

                                    @if($lead->lead_region != '')
                                        , {{ $lead->lead_region }}
                                    @endif
                                </span>
                                </p>

                                @if($lead->lead_address != '')
                                <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2 ">{{ $lead->lead_address }}</span></p>
                                @endif

                                @if($lead->lead_birth_day != '')
                                <p class="text-muted mb-1 font-13"><strong>Birth Date :</strong> <span class="ml-2">
                                {{ $lead->lead_birth_day.'/'.$lead->lead_birth_month.'/'.$lead->lead_birth_year }}
                                </span></p>
                                @endif

                                @if($lead->lead_website != '')
                                <p class="text-muted mb-2 font-13"><strong>Website :</strong> <span class="ml-2 ">{{ $lead->lead_website }}</span></p>
                                @endif

                                <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ml-2 ">{{ $lead->gender->gender_name }}</span></p>
                                
                                @if($lead->lead_details != '')
                                <br/>
                                <h4 class="font-13 text-uppercase">Other Details :</h4>
                                <p class="text-muted font-13 mb-3">
                                    {{ $lead->lead_details }}
                                </p>
                                @endif
                            </div>

                        </div> <!-- end card-box -->

                        <div class="card-box">
                            <h4 class="header-title mb-3">Activities</h4>

                            <div class="inbox-widget slimscroll" style="max-height: 310px;">
                                @forelse($leadActivities as $activity)
                                <div class="inbox-item">
                                    <p class="inbox-item-author">{{ $activity->activity_subject }}</p>
                                    <p class="inbox-item-text"><b>{{ $activity->activityTarget->activity_target_name }}</b> - {{ $activity->activity_start_date }}</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-light text-info font-13" data-toggle="modal" data-target="#modal-preview{{ $activity->activity_id }}"> Preview </a>
                                    </p>
                                </div>
                                <!-- Modal Preview Activity -->
                                <div id="modal-preview{{ $activity->activity_id }}" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content bg-default">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mySmallModalLabel">{{ ucwords($activity->activityType->activity_type_name) }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body p-4 text-left">
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
                                                    <a href="{{ url('update/activity').'/'.$activity->activity_id }}" class="btn btn-light">
                                                    Edit
                                                    </a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div> <!-- // END .modal-body -->
                                        </div> <!-- // END .modal-content -->
                                    </div> <!-- // END .modal-dialog -->
                                </div> <!-- // END .modal -->
                                @empty
                                <div class="inbox-item">
                                    <p class="inbox-item-text">No Activities</p>
                                </div>
                                @endforelse
                            </div> <!-- end inbox-widget -->

                        </div> <!-- end card-box-->

                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">
                        <div class="card-box">
                            <ul class="nav nav-pills navtab-bg">
                                <li class="nav-item">
                                    <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link active" style="cursor: pointer;">
                                        <i class="mdi mdi-timeline mr-1"></i>Timeline
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#timeline" data-toggle="tab" aria-expanded="false" class="nav-link" style="cursor: pointer;">
                                        <i class="mdi mdi-comment mr-1"></i>
                                        Notes 
                                        @if(getNoteCount($lead->lead_id) !== 0 || getNoteCount($lead->lead_id) !== null)
                                        (<span class="note-count-content">{{ getNoteCount($lead->lead_id) }}</span>)
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                
                                <div class="tab-pane show active" id="timeline">

                                    <!-- comment box -->
                                    <div id="note-form">
                                        <form action="{{ url('add/lead/note') }}" method="POST" class="comment-area-box mt-2 mb-3">
                                            @csrf
                                            <input type="hidden" name="note_user_id" value="{{ auth::user()->user_id }}" />
                                            <input type="hidden" name="note_lead_id" value="{{ $lead->lead_id }}" />
                                            <textarea id="summernote-editor" name="note_content" rows="3">Write Note ..</textarea>
                                            <button type="submit" class="btn btn-sm btn-dark waves-effect waves-light mt-2">Post</button>
                                        </form>
                                    </div>
                                    <!--
                                    <form action="{{ url('add/lead/note') }}" method="POST" class="comment-area-box mt-2 mb-3">
                                        @csrf
                                        <input type="hidden" name="note_user_id" value="{{ auth::user()->user_id }}" />
                                        <input type="hidden" name="note_lead_id" value="{{ $lead->lead_id }}" />
                                        <span class="input-icon">
                                            <textarea rows="3" name="note_content" class="form-control" placeholder="Write something..."></textarea>
                                        </span>
                                        <div class="comment-area-btn">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-sm btn-dark waves-effect waves-light">Post</button>
                                            </div>
                                            <div>
                                                <a href="#" class="btn btn-sm btn-light text-white-50"><i class="far fa-user"></i></a>
                                                <a href="#" class="btn btn-sm btn-light text-white-50"><i class="fa fa-map-marker-alt"></i></a>
                                                <a href="#" class="btn btn-sm btn-light text-white-50"><i class="fa fa-camera"></i></a>
                                                <a href="#" class="btn btn-sm btn-light text-white-50"><i class="far fa-smile"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                    -->
                                    <!-- end comment box -->

                                    @foreach($notes as $note)
                                    <!-- Story Box-->
                                    <div class="border border-light p-2 mb-3">
                                        <div class="media">
                                            @if($note->user->user_image == NULL)
                                            <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('assets/images/avatar.png') }}"
                                                alt="Generic placeholder image">
                                            @else
                                            <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('uploads/images/users/').'/'.$note->user->user_image }}"
                                                alt="Generic placeholder image">
                                            @endif
                                            <div class="media-body">
                                                <h5 class="m-0">
                                                    {{ ucwords($note->user->user_first_name) }} {{ ucwords($note->user->user_last_name) }}
                                                    @if($note->user->user_id == auth::user()->user_id)
                                                    <span class="badge badge-danger" style="font-size: 10px !important">
                                                    You
                                                    </span>
                                                    @endif
                                                </h5>
                                                <p class="text-muted"><small>{{ changeDateFromate(getMysqlDate($note->note_date)) }}</small></p>
                                                <p>{!! $note->note_content !!}</p>
                                                
                                                <!-- Replays -->
                                                @if(getReplayCount($note->note_id) !== 0)
                                                <a href="javascript: void(0);" class="text-muted replay-btn font-13 d-inline-block mt-2"><i class="mdi mdi-reply"></i> Reply <small>({{ getReplayCount($note->note_id) }})</small></a>
                                                @endif
                                                <div class="replay-section"> 
                                                    @if(getReplay($note->note_id) !== null)
                                                        @foreach(getReplay($note->note_id) as $replay)
                                                        <div class="media mt-3">
                                                            <a class="pr-2" href="#">
                                                                @if($replay->user->user_image == NULL)
                                                                <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('assets/images/avatar.png') }}"
                                                                    alt="Generic placeholder image">
                                                                @else
                                                                <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('uploads/images/users/').'/'.$replay->user->user_image }}"
                                                                    alt="Generic placeholder image">
                                                                @endif
                                                            </a>
                                                            <div class="media-body">
                                                                <h5 class="mt-0">{{ ucwords($replay->user->user_first_name) }} {{ ucwords($replay->user->user_last_name) }} <small class="text-muted">{{ changeDateFromate(getMysqlDate($replay->replay_date)) }}</small></h5>
                                                                {{ $replay->replay_content }}
                                                            </div>
                                                        </div>
                                                        <!-- Replays -->
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Send Replay -->
                                        <div class="media mt-2">
                                            <a class="pr-2" href="#">
                                                @if($note->user->user_image == NULL)
                                                <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('assets/images/avatar.png') }}"
                                                    alt="Generic placeholder image">
                                                @else
                                                <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('uploads/images/users/').'/'.auth::user()->user_image }}"
                                                    alt="Generic placeholder image">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <form action="{{ url('add/lead/replay') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="replay_note_id" value="{{ $note->note_id }}">
                                                    <input type="hidden" name="replay_user_id" value="{{ auth::user()->user_id }}">
                                                    <textarea type="text" name="replay_content" class="form-control border-0 form-control-sm" placeholder="Add replay"></textarea>
                                                    <button class="btn btn-dark btn-sm mt-2">send</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Send Replay -->
                                        <!-- Edit / Delete Post -->
                                        @if($note->user->user_id == auth::user()->user_id)
                                        <div class="mt-2">
                                            <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted edit-btn" data-edit="edit{{ $note->note_id }}"><i class="mdi mdi-pencil"></i> Edit</a>
                                            <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted" data-toggle="modal" data-target="#modal-delete{{ $note->note_id }}"><i class="mdi mdi-delete"></i> Delete</a>
                                        </div>
                                        <!-- Edit / Delete Post -->
                                        <!-- Edit Form -->
                                        <div class="media mt-2 edit-section edit{{ $note->note_id }}">
                                            <div class="media-body">
                                                <form action="{{ url('update/lead/note') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="note_id" value="{{ $note->note_id }}">
                                                    <input type="hidden" name="note_lead_id" value="{{ $note->note_lead_id }}">
                                                    <input type="hidden" name="note_user_id" value="{{ $note->note_user_id }}">
                                                    <textarea type="text" name="note_content" rows="4" class="form-control border-0 form-control-sm" value="{{ $note->note_content }}" placeholder="...">{{ $note->note_content }}</textarea>
                                                    <button type="submit" class="btn btn-dark btn-sm mt-2">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Edit Form -->
                                        @endif
                                    </div>

                                    <!-- Delete Note Model -->
                                    <div id="modal-delete{{ $note->note_id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-body text-center p-4">
                                                    <form action="{{ url('delete/lead/note') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="note_id" value="{{ $note->note_id }}">
                                                        <input type="hidden" name="note_user_id" value="{{ auth::user()->user_id }}"/>
                                                        <input type="hidden" name="note_lead_id" value="{{ $note->note_lead_id }}"/>
                                                        <i class="fas fa-exclamation-triangle" style="font-size: 30px;"></i>
                                                        <h4 class="text-white">Warning!</h4>
                                                        <p class="text-white mt-3">Are you sure you want to delete this note permanently?</p>
                                                        <button type="submit" class="btn btn-light my-2">Yes, continue</button>
                                                        <button type="button" class="btn btn-light my-2" data-dismiss="modal">Cancel</button>
                                                    </form>
                                                </div> <!-- // END .modal-body -->
                                            </div> <!-- // END .modal-content -->
                                        </div> <!-- // END .modal-dialog -->
                                    </div> <!-- // END .modal -->
                                    @endforeach

                                    {{ $notes->links() }}

                                </div>
                                <!-- end timeline content-->

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <!-- Modal Add Task -->
                <div id="modal-add-task" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content bg-default">
                            <div class="modal-header">
                                <h4 class="modal-title" id="mySmallModalLabel">Add Task <small>({{ $lead->lead_first_name.' '.$lead->lead_last_name }})</small></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body text-center p-4">
                                <form action="{{ url('add/activity/request') }}" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: left !important;">
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
                                                            <option value="{{ $lead->lead_id }}" selected="">- {{ $lead->lead_full_name }} -</option>
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

                <!-- Lead Add Activity (Modal) -->
                <div id="modal-lead-activity" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content bg-default">
                            <div class="modal-header">
                                <h4 class="modal-title" id="mySmallModalLabel">Add Activity</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body text-center p-4">
                                <form action="{{ url('add/activity/request') }}" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: left !important;">
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
                                                        <input type="date" class="form-control" id="activity_start_date" name="activity_start_date">
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

                <!-- Delete Modal -->
                <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content bg-danger">
                            <div class="modal-body text-center p-4">
                                <i class="fas fa-exclamation-triangle" style="font-size: 30px;"></i>
                                <h4 class="text-white">Warning!</h4>
                                <p class="text-white mt-3">Are you sure you want to delete this data permanently?</p>
                                <form action="{{ url('delete/lead') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="lead_id[]" value="{{ $lead->lead_id }}">
                                    <button type="submit"
                                            class="btn btn-light my-2"
                                            >Yes, continue</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Cancel</button>
                                </form>
                            </div> <!-- // END .modal-body -->
                        </div> <!-- // END .modal-content -->
                    </div> <!-- // END .modal-dialog -->
                </div> <!-- // END .modal -->

    @include('layouts/footer')

@endsection