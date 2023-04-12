@extends('layouts.app')
@section('title', 'Update Lead')

@section('content')
    
    @include('layouts/header')


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Leads</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Lead</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($AllLeads as $lead)
            <div class="">
                <form action="{{ url('update/lead/request') }}" method="POST" class="ajax-form" data-redirect="update" enctype="multipart/form-data" style="width: 100%">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
                <div class="card card-form">
                    <div class="row m-0">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Lead</strong>
                        </div>
                        <div class="col-lg-9 card-form__body card-body d-flex align-items-center">
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item dz-success">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    @if($lead->lead_image == null)
                                                    <img src="{{ asset('assets/images/avatar.png') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    @else
                                                    <img src="{{ asset('uploads/images/leads/').'/'.$lead->lead_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold" data-dz-name="">{{ ucwords($lead->lead_first_name.' '.$lead->lead_last_name) }}</div>
                                                <p class="small text-muted mb-0" data-dz-size=""><strong>{{ $lead->country->country_name }}</strong>
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
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-form">
                    <div class="row m-0">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Personal Info.</strong></p>
                        </div>
                        <div class="col-lg-9 card-form__body card-body"> 
                            <div class="row">               
                                <div class="form-group col-sm-6">
                                    <label for="lead_first_name">First name: <span class="red-req">*</span></label>
                                    <input type="text" class="form-control @error('lead_first_name') is-invalid @enderror" id="lead_first_name" name="lead_first_name" value="{{ $lead->lead_first_name }}" placeholder="first name" required >
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="lead_last_name">last name: <span class="red-req">*</span></label>
                                    <input type="text" class="form-control @error('lead_last_name') is-invalid @enderror" id="lead_last_name" name="lead_last_name" value="{{ $lead->lead_last_name }}" placeholder="last name" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lead_full_name">Full name: <span class="red-req">*</span></label>
                                <input type="text" class="form-control @error('lead_full_name') is-invalid @enderror" id="lead_full_name" name="lead_full_name" value="{{ $lead->lead_full_name }}" placeholder="full name" required >
                            </div>
                            <div class="form-group">
                                <label for="lead_company">Company:</label>
                                <select class="form-control selectpicker-search" name="lead_company" id="lead_company">
                                    @if($lead->lead_company == null)
                                    <option value="" selected="">---</option>
                                    @else
                                    <option value="{{ $lead->company_id }}" selected="">{{ $lead->company->company_name }}</option>
                                    @endif
                                    @foreach($companies as $company)
                                    <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lead_email">E-mail:</label>
                                <input type="email" class="form-control @error('lead_email') is-invalid @enderror" id="lead_email" name="lead_email" value="{{ $lead->lead_email }}" placeholder="email">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 col-12 form-group">
                                        <label>Gender: <span class="red-req">*</span></label>
                                        <select class="form-control selectpicker-default @error('lead_gender') is-invalid @enderror" name="lead_gender" required >
                                            <option value="{{ $lead->lead_gender }}" selected="">{{ $lead->gender->gender_name }}</option>
                                            @foreach($genders as $gender)
                                            <option value="{{ $gender->gender_id }}">{{ $gender->gender_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-12 form-group">
                                        <label>Status: <span class="red-req">*</span></label>
                                        <select class="form-control selectpicker-default @error('lead_status') is-invalid @enderror" name="lead_status" required >
                                            <option value="{{ $lead->lead_status }}" selected="">{{ $lead->status->status_name }}</option>
                                            @foreach($status as $st)
                                            <option value="{{ $st->status_id }}">{{ $st->status_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-12 form-group">
                                        <label>Sources:</label>
                                        <select class="form-control selectpicker-default @error('lead_source') is-invalid @enderror" name="lead_source" required >
                                            <option value="{{ $lead->lead_source }}" selected="">{{ $lead->source->source_name }}</option>
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
                                            <option value="{{ $lead->lead_birth_day }}" selected="">Day - {{ $lead->lead_birth_day }}</option>
                                            @for($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <select class="form-control selectpicker-default" name="lead_birth_month">
                                            <option value="{{ $lead->lead_birth_month }}" selected="">Month - {{ $lead->lead_birth_month }}</option>
                                            @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <select class="form-control selectpicker-search" name="lead_birth_year">
                                            <option value="{{ $lead->lead_birth_year }}" selected="">Year - {{ $lead->lead_birth_year }}</option>
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
                                        <input type="text" class="form-control @error('lead_address') is-invalid @enderror" id="lead_address" name="lead_address" value="{{ $lead->lead_address }}" placeholder="123 Main Street, New York, NY 10030">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="lead_city">City:</label>
                                        <input type="text" class="form-control @error('lead_city') is-invalid @enderror" id="lead_city" name="lead_city" value="{{ $lead->lead_city }}" placeholder="city">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="lead_region">Region:</label>
                                        <input type="text" class="form-control @error('lead_region') is-invalid @enderror" id="lead_region" name="lead_region" value="{{ $lead->lead_region }}" placeholder="region">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="lead_country">Country: <span class="red-req">*</span></label>
                                        <select class="form-control selectpicker-search" name="lead_country" id="lead_country">
                                            <option value="{{ $lead->lead_country }}" selected="">{{ $lead->country->country_name }}</option>
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
                                        <input type="text" class="form-control @error('lead_phone') is-invalid @enderror" id="lead_phone" name="lead_phone" value="{{ $lead->lead_phone }}" placeholder="01069200923">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="lead_fax">Fax:</label>
                                        <input type="text" class="form-control @error('lead_fax') is-invalid @enderror" id="lead_fax" name="lead_fax" value="{{ $lead->lead_fax }}" placeholder="+1 (xxx) xxx-xxxx">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="lead_website">Website:</label>
                                        <input type="text" class="form-control @error('lead_website') is-invalid @enderror" id="lead_website" name="lead_website" value="{{ $lead->lead_website }}" placeholder="91ahmed.github.io">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="lead_postal_code">Postal Code:</label>
                                        <input type="text" class="form-control @error('lead_postal_code') is-invalid @enderror" id="lead_postal_code" name="lead_postal_code" value="{{ $lead->lead_postal_code }}" placeholder="00000">
                                    </div>             
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card card-form"> 
                    <div class="row m-0">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Assigned To. <span class="red-req">*</span></strong></p>
                        </div>
                        <div class="col-lg-9 card-form__body card-body">                
                            <div class="form-group">
                                <select class="form-control" name="lead_assigned_to" required >
                                    <option value="{{ $lead->lead_assigned_to }}" selected>{{ $lead->user->user_full_name }}</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->user_full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card card-form"> 
                    <div class="row m-0">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Other Details.</strong></p>
                        </div>
                        <div class="col-lg-9 card-form__body card-body">                
                            <div class="form-group">
                                <textarea class="form-control @error('lead_details') is-invalid @enderror" name="lead_details" value="{{ $lead->lead_details }}" placeholder="Description" rows="5">{{ $lead->lead_details }}</textarea>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card card-form">
                    <div class="row m-0">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color">Lead Photo</strong></p>
                            <p class="text-muted">The file must be an image like jpeg, png, bmp, svg, or webp</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body d-flex align-items-center">
                            <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                <ul class="dz-preview dz-preview-multiple list-group list-group-flush">
                                    @if($lead->lead_image == null)
                                    <li class="list-group-item dz-success">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <img src="{{ asset('assets/images/avatar.png') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold filename" data-dz-name="">photo.jpg</div>
                                                <p class="small text-muted mb-0 filesize" data-dz-size=""><strong>12.9</strong> KB</p>
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li class="list-group-item dz-success">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <img src="{{ asset('uploads/images/leads/').'/'.$lead->lead_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold filename" data-dz-name=""></div>
                                                <p class="small text-muted mb-0 filesize" data-dz-size=""><strong></strong></p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </ul>

                                <div>
                                    <input type="hidden" name="lead_old_image" value="{{ $lead->lead_image }}">
                                    <input type="file" name="lead_image" id="lead_image" class="form-control file" />
                                    <button class="btn btn-warning dz-button file-trigger" type="button">Choose files to upload</button>
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