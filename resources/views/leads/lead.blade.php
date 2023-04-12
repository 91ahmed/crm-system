@extends('layouts.app')
@section('title', 'Leads')

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
                                aria-current="page">Leads</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Leads</h4>
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
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-lead">
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

                                    <form action="{{ url('delete/lead') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <table class="table table-hover mb-0 thead-border-top-0 dataTable" id="dbtable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 18px;">
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input" id="check_all">
                                                            <label class="custom-control-label" for="check_all"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </th>
                                                    <th>Image</th>
                                                    <th><div style="width: 150px;">Name</div></th>
                                                    <th>E-mail</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th><div style="width: 100px;">Assigned To</div></th>
                                                    <th><div style="width: 100px;">Options</div></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" data-column="2" placeholder="search name">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" data-column="3" placeholder="search e-mail">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" data-column="4" placeholder="search phone">
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-default" data-column="5">
                                                            <option value="" selected>- select status -</option>
                                                            @foreach($status as $st)
                                                            <option value="{{ $st->status_name }}">{{ $st->status_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-search" data-column="6">
                                                            <option value="" selected>- select user -</option>
                                                            @foreach($users as $user)
                                                            <option value="{{ $user->user_first_name }} {{ $user->user_last_name }}">{{ $user->user_first_name }} {{ $user->user_last_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($AllLeads as $lead)
                                                <tr class="table-row">
                                                    <td>
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $lead->lead_id }}" name="lead_id[]" value="{{ $lead->lead_id }}">
                                                            <label class="custom-control-label" for="check{{ $lead->lead_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
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
                                                        {{ $lead->lead_full_name }}
                                                    </td>
                                                    <td>{{ $lead->lead_email }}</td>
                                                    <td>
                                                        @if($lead->lead_phone == null)
                                                        <small class="text-muted">
                                                        ----
                                                        <br/>
                                                        {{ $lead->country->country_name }}
                                                        </small>
                                                        @else
                                                        <small class="text-muted">
                                                            +({{ $lead->country->country_code }}) {{ $lead->lead_phone }}
                                                            <br/>
                                                            {{ $lead->country->country_name }}
                                                        </small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($lead->lead_status == 1)
                                                        <span class="badge badge-warning">
                                                        @elseif($lead->lead_status == 2)
                                                        <span class="badge badge-info">
                                                        @elseif($lead->lead_status == 3)
                                                        <span class="badge badge-primary">
                                                        @elseif($lead->lead_status == 4)
                                                        <span class="badge badge-success">
                                                        @elseif($lead->lead_status == 5)
                                                        <span class="badge badge-danger">
                                                        @elseif($lead->lead_status == 6)
                                                        <span class="badge badge-dark">
                                                        @elseif($lead->lead_status == 7)
                                                        <span class="badge badge-light">
                                                        @else
                                                        <span class="badge badge-default">
                                                        @endif
                                                            {{ ucwords($lead->status->status_name) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('profile/user').'/'.$lead->user->user_id }}" data-toggle="tooltip" data-placement="top" title="{{ $lead->user->user_full_name }}" data-original-title="{{ $lead->user->user_full_name }}"> <small">{{ $lead->user->user_first_name }} {{ $lead->user->user_last_name }}</small></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('profile/lead').'/'.$lead->lead_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('update/lead').'/'.$lead->lead_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
                                                        <i class="fas fa-wrench"></i>
                                                        </a>
                                                    </td>
                                                </tr>
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

            <!-- Modal Lead -->
            <div id="modal-lead" class="modal bs-example-modal-lg">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Lead</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">

                        <div class="row no-gutters">
                            <form action="{{ url('add/lead/request') }}" method="POST" class="ajax-form" data-redirect="{{ url('leads') }}" enctype="multipart/form-data" style="width: 100%;">
                                @csrf
                                <div class="card card-form">
                                    <div class="card-header">
                                        Personal Info
                                    </div>
                                    <div class="card-form__body card-body"> 
                                        <div class="row">               
                                            <div class="form-group col-sm-6">
                                                <label for="lead_first_name">First name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('lead_first_name') is-invalid @enderror" id="lead_first_name" name="lead_first_name" value="{{ old('lead_first_name') }}" placeholder="first name" required >
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lead_last_name">last name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('lead_last_name') is-invalid @enderror" id="lead_last_name" name="lead_last_name" value="{{ old('lead_last_name') }}" placeholder="last name" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lead_full_name">Full name: <span class="red-req">*</span></label>
                                            <input type="text" class="form-control @error('lead_full_name') is-invalid @enderror" id="lead_full_name" name="lead_full_name" value="{{ old('lead_full_name') }}" placeholder="full name" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="lead_company">Company:</label>
                                            <select class="form-control selectpicker-search" name="lead_company" id="lead_company">
                                                <option value="" selected="">Company</option>
                                                @foreach($companies as $company)
                                                <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lead_email">E-mail:</label>
                                            <input type="email" class="form-control @error('lead_email') is-invalid @enderror" id="lead_email" name="lead_email" value="{{ old('lead_email') }}" placeholder="email">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 col-12 form-group">
                                                    <label>Gender: <span class="red-req">*</span></label>
                                                    <select class="form-control selectpicker-default @error('lead_gender') is-invalid @enderror" name="lead_gender" required >
                                                        <option value="" selected="">Gender</option>
                                                        @foreach($genders as $gender)
                                                        <option value="{{ $gender->gender_id }}">{{ $gender->gender_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 col-12 form-group">
                                                    <label>Status: <span class="red-req">*</span></label>
                                                    <select class="form-control selectpicker-default @error('lead_status') is-invalid @enderror" name="lead_status" required >
                                                        <option value="" selected="">Status</option>
                                                        @foreach($status as $st)
                                                        <option value="{{ $st->status_id }}">{{ $st->status_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 col-12 form-group">
                                                    <label>Source:</label>
                                                    <select class="form-control selectpicker-default @error('lead_source') is-invalid @enderror" name="lead_source" required >
                                                        <option value="" selected="">Source</option>
                                                        @foreach($sources as $source)
                                                        <option value="{{ $source->source_id }}">{{ $source->source_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label>Birth Date:</label>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <select class="form-control selectpicker-default" name="lead_birth_day">
                                                        <option value="" selected="">Day</option>
                                                        @for($day = 1; $day <= 31; $day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <select class="form-control selectpicker-default" name="lead_birth_month">
                                                        <option value="" selected="">Month</option>
                                                        @for($month = 1; $month <= 12; $month++)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <select class="form-control selectpicker-search" name="lead_birth_year">
                                                        <option value="" selected="">Year</option>
                                                        @for($year = date('Y')-100; $year <= date('Y'); $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="lead_address">Address:</label>
                                                    <input type="text" class="form-control @error('lead_address') is-invalid @enderror" id="lead_address" name="lead_address" value="{{ old('lead_address') }}" placeholder="123 Main Street, New York, NY 10030">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_city">City:</label>
                                                    <input type="text" class="form-control @error('lead_city') is-invalid @enderror" id="lead_city" name="lead_city" value="{{ old('lead_city') }}" placeholder="city">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_region">Region:</label>
                                                    <input type="text" class="form-control @error('lead_region') is-invalid @enderror" id="lead_region" name="lead_region" value="{{ old('lead_region') }}" placeholder="region">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_country">Country: <span class="red-req">*</span></label>
                                                    <select class="form-control selectpicker-search" name="lead_country" id="lead_country">
                                                        <option value="" selected="">Country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>              
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_phone">Phone:</label>
                                                    <input type="text" class="form-control @error('lead_phone') is-invalid @enderror" id="lead_phone" name="lead_phone" value="{{ old('lead_phone') }}" placeholder="01069200923">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_fax">Fax:</label>
                                                    <input type="text" class="form-control @error('lead_fax') is-invalid @enderror" id="lead_fax" name="lead_fax" value="{{ old('lead_fax') }}" placeholder="+1 (xxx) xxx-xxxx">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label for="lead_website">Website:</label>
                                                    <input type="text" class="form-control @error('lead_website') is-invalid @enderror" id="lead_website" name="lead_website" value="{{ old('lead_website') }}" placeholder="91ahmed.github.io">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="lead_postal_code">Postal Code:</label>
                                                    <input type="text" class="form-control @error('lead_postal_code') is-invalid @enderror" id="lead_postal_code" name="lead_postal_code" value="{{ old('lead_postal_code') }}" placeholder="00000">
                                                </div>             
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="card card-form"> 
                                    <div class="card-header">
                                        Assigned To
                                    </div>
                                    <div class="card-form__body card-body">                
                                        <div class="form-group">
                                            <select class="form-control selectpicker-search" name="lead_assigned_to" required >
                                                <option value="{{ Auth::user()->user_id }}" selected>{{ Auth::user()->user_full_name }}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->user_full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="card card-form">
                                    <div class="card-header">
                                        Other Details
                                    </div>
                                    <div class="card-form__body card-body">                
                                        <div class="form-group">
                                            <textarea class="form-control @error('lead_details') is-invalid @enderror" name="lead_details" value="{{ old('lead_details') }}" placeholder="Description" rows="5"></textarea>
                                        </div>
                                    </div> 
                                </div>
                                <div class="card card-form">
                                    <div class="card-header">
                                        Lead Photo
                                        <p class="text-muted">The file must be an image like jpeg, png, bmp, svg, or webp</p>
                                    </div>
                                    <div class="card-form__body card-body d-flex align-items-center">
                                        <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                            <ul class="dz-preview dz-preview-multiple list-group list-group-flush"><li class="list-group-item dz-success dz-complete">
                                                    <div class="form-row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/images/avatar.png') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="font-weight-bold filename" data-dz-name="">photo.jpg</div>
                                                            <p class="small text-muted mb-0 filesize" data-dz-size=""><strong>12.3</strong> KB</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <div>
                                                <input type="file" name="lead_image" id="lead_image" class="form-control file" />
                                                <button class="btn btn-warning dz-button file-trigger" type="button">Choose files to upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-form">
                                    <div class="row m-0">
                                        <div class="col-12 card-form__body card-body">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-light my-2" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        </div> <!-- // END .modal-body -->
                    </div> <!-- // END .modal-content -->
                </div> <!-- // END .modal-dialog -->
            </div> <!-- // END .modal -->
    
    @include('layouts/footer')

@endsection