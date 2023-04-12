@extends('layouts.app')
@section('title', 'User Profile')

@section('content')
    
    @include('layouts/header')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
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
                            @if($user->user_image == null)
                            <img src="{{ asset('assets/images/avatar.png') }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @else
                            <img src="{{ asset('uploads/images/users/').'/'.$user->user_image }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @endif

                            <h4 class="mb-0">{{ ucwords($user->user_first_name.' '.$user->user_last_name) }}</h4>
                            <p class="text-muted">{{ ucwords($user->role->role_name) }}</p>

                            <a href="{{ url('update/user/').'/'.$user->user_id }}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Edit</a>
                            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light" data-toggle="modal" data-target="#modal-delete">Delete</button>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Website" data-original-title="Website">
                                    <a href="{{ $user->user_website }}" target="_blank" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-earth"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Call" data-original-title="Call">
                                    <a href="tel: +{{ $user->country->country_code.''.$user->user_phone }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-phone"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send E-mail" data-original-title="Send E-mail">
                                    <a href="mailto: {{ $user->email }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-email"></i></a>
                                </li>
                            </ul>

                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase">About Me :</h4>
                                <p class="text-muted font-13 mb-3">
                                    Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type.
                                </p>
                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ ucwords($user->user_full_name) }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Role :</strong> <span class="badge badge-info">{{ ucwords($user->role->role_name) }}</span></p>

                                @if($user->user_phone != '')
                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">+ ({{ $user->country->country_code }}) {{ $user->user_phone }}</span></p>
                                @endif

                                @if($user->user_fax != '')
                                <p class="text-muted mb-2 font-13"><strong>Fax :</strong><span class="ml-2">{{ $user->user_fax }}</span></p>
                                @endif

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $user->email }}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">
                                    {{ $user->country->country_name }}

                                    @if($user->user_city != '')
                                        , {{ $user->user_city }}
                                    @endif

                                    @if($user->user_region != '')
                                        , {{ $user->user_region }}
                                    @endif
                                </span>
                                </p>

                                @if($user->user_address != '')
                                <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2 ">{{ $user->user_address }}</span></p>
                                @endif

                                @if($user->user_birth_day != '')
                                <p class="text-muted mb-1 font-13"><strong>Birth Date :</strong> <span class="ml-2">
                                {{ $user->user_birth_day.'/'.$user->user_birth_month.'/'.$user->user_birth_year }}
                                </span></p>
                                @endif

                                @if($user->user_website != '')
                                <p class="text-muted mb-2 font-13"><strong>Website :</strong> <span class="ml-2 ">{{ $user->user_website }}</span></p>
                                @endif

                                <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ml-2 ">{{ $user->gender->gender_name }}</span></p>

                                @if($user->permission !== '')
                                <h4 class="font-13 text-uppercase mt-3">Permission :</h4>
                                <p class="text-muted font-13 mb-3">
                                    @foreach($user->permission as $permission)
                                    <span class="badge badge-light">{{ strtoupper($permission->permission_name) }}</span>
                                    @endforeach
                                </p>
                                @endif
                                
                                @if($user->user_details != '')
                                <h4 class="font-13 text-uppercase mt-3">Other Details :</h4>
                                <p class="text-muted font-13 mb-3">
                                    {{ $user->user_details }}
                                </p>
                                @endif
                            </div>

                        </div> <!-- end card-box -->

                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">

                        <div class="card-box">
                            <h4 class="header-title mb-3">Activities ({{ $userActivitiesCount }})</h4>

                            <div class="inbox-widget slimscroll" style="max-height: 310px;">
                                @forelse($userActivities as $activity)
                                <div class="inbox-item">
                                    <p class="inbox-item-author">{{ $activity->activity_subject }}</p>
                                    <p class="inbox-item-text"><b>{{ $activity->activityTarget->activity_target_name }}</b> - {{ $activity->activity_start_date }}</p>
                                    <p class="inbox-item-date">
                                        <a href="#" class="btn btn-sm btn-light text-info font-13" data-toggle="modal" data-target="#modal-preview{{ $activity->activity_id }}"> Preview </a>
                                    </p>
                                </div>
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

                        <div class="card-box">
                            <h4 class="header-title mb-3">Leads ({{ $userLeadsCount }})</h4>

                            <table class="table table-hover dataTable" id="dbtable">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Preview</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userLeads as $lead)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-xs mr-2">
                                                    @if($lead->lead_image == NULL)
                                                    <img src="{{ asset('assets/images/avatar.png') }}" alt="Avatar" class="avatar-img rounded-circle">
                                                    @else
                                                    <img src="{{ asset('uploads/images/leads/').'/'.$lead->lead_image }}" alt="Avatar" class="avatar-img rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $lead->lead_full_name }}<br/>
                                            <span class="badge badge-light">{{ $lead->status->status_name }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ url('profile/lead').'/'.$lead->lead_id }}" class="btn btn-sm btn-light text-info font-13"> Profile </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <!-- Delete Modal -->
                <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content bg-danger">
                            <div class="modal-body text-center p-4">
                                <i class="fas fa-exclamation-triangle" style="font-size: 30px;"></i>
                                <h4 class="text-white">Warning!</h4>
                                <p class="text-white mt-3">Are you sure you want to delete this data permanently?</p>
                                <form action="{{ url('delete/user') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="user_id[]" value="{{ $user->user_id }}">
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