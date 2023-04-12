@extends('layouts.app')
@section('title', 'Update User')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update User</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($allUsers as $user)
            <div class="row no-gutters">       
                <form action="{{ url('update/user/request') }}" method="POST" class="ajax-form" data-redirect="update" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-lg-3 card-body">
                                <p><strong class="headings-color">User</strong>
                            </div>
                            <div class="col-lg-9 card-form__body card-body d-flex align-items-center">
                                <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                    <ul class="dz-preview dz-preview-multiple list-group list-group-flush">
                                        @if($user->user_image == null)
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img src="{{ asset('assets/images/avatar.png') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-bold" data-dz-name="">{{ ucwords($user->user_first_name.' '.$user->user_last_name) }}</div>
                                                    <p class="small text-muted mb-0" data-dz-size=""><strong>{{ $user->role->role_name }}</strong></p>
                                                </div>
                                            </div>
                                        </li>
                                        @else
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img src="{{ asset('uploads/images/users/').'/'.$user->user_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-bold" data-dz-name="">{{ ucwords($user->user_first_name.' '.$user->user_last_name) }}</div>
                                                    <p class="small text-muted mb-0" data-dz-size=""><strong>{{ $user->role->role_name }}</strong></p>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
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
                                        <label for="user_first_name">First name: <span class="red-req">*</span></label>
                                        <input type="text" class="form-control @error('user_first_name') is-invalid @enderror" id="user_first_name" name="user_first_name" value="{{ $user->user_first_name }}" placeholder="first name">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="user_last_name">last name: <span class="red-req">*</span></label>
                                        <input type="text" class="form-control @error('user_last_name') is-invalid @enderror" id="user_last_name" name="user_last_name" value="{{ $user->user_last_name }}" placeholder="last name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_full_name">Full name: <span class="red-req">*</span></label>
                                    <input type="text" class="form-control @error('user_full_name') is-invalid @enderror" id="user_full_name" name="user_full_name" value="{{ $user->user_full_name }}" placeholder="full name">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label>Gender: <span class="red-req">*</span></label>
                                            <select class="form-control selectpicker-default @error('user_gender') is-invalid @enderror" name="user_gender">
                                                <option value="{{ $user->user_gender }}" selected="">{{ $user->gender->gender_name }}</option>
                                                @foreach($genders as $gender)
                                                <option value="{{ $gender->gender_id }}">{{ $gender->gender_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label>Role: <span class="red-req">*</span></label>
                                            <select class="form-control selectpicker-default @error('user_role') is-invalid @enderror" name="user_role">
                                                <option value="{{ $user->user_role }}" selected="">{{ $user->role->role_name }}</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
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
                                            <select class="form-control selectpicker-default" name="user_birth_day">
                                                <option value="{{ $user->user_birth_day }}" selected="">Day - {{ $user->user_birth_day }}</option>
                                                @for($day = 1; $day <= 31; $day++)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <select class="form-control selectpicker-default" name="user_birth_month">
                                                <option value="{{ $user->user_birth_month }}" selected="">Month - {{ $user->user_birth_month }}</option>
                                                @for($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <select class="form-control selectpicker-search" name="user_birth_year">
                                                <option value="{{ $user->user_birth_year }}" selected="">Year - {{ $user->user_birth_year }}</option>
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
                                            <label for="user_address">Address:</label>
                                            <input type="text" class="form-control @error('user_address') is-invalid @enderror" id="user_address" name="user_address" value="{{ $user->user_address }}" placeholder="123 Main Street, New York, NY 10030">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label for="user_city">City:</label>
                                            <input type="text" class="form-control @error('user_city') is-invalid @enderror" id="user_city" name="user_city" value="{{ $user->user_city }}" placeholder="city">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="user_region">Region:</label>
                                            <input type="text" class="form-control @error('user_region') is-invalid @enderror" id="user_region" name="user_region" value="{{ $user->user_region }}" placeholder="region">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="user_country">Country: <span class="red-req">*</span></label>
                                            <select class="form-control selectpicker-search" name="user_country" id="user_country">
                                                <option value="{{ $user->user_country }}" selected="">{{ $user->country->country_name }}</option>
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
                                            <label for="user_phone">Phone:</label>
                                            <input type="text" class="form-control @error('user_phone') is-invalid @enderror" id="user_phone" name="user_phone" value="{{ $user->user_phone }}" placeholder="01069200923">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="user_fax">Fax:</label>
                                            <input type="text" class="form-control @error('user_fax') is-invalid @enderror" id="user_fax" name="user_fax" value="{{ $user->user_fax }}" placeholder="+1 (xxx) xxx-xxxx">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="user_website">Website:</label>
                                            <input type="text" class="form-control @error('user_website') is-invalid @enderror" id="user_website" name="user_website" value="{{ $user->user_website }}" placeholder="91ahmed.github.io">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="user_postal_code">Postal Code:</label>
                                            <input type="text" class="form-control @error('user_postal_code') is-invalid @enderror" id="user_postal_code" name="user_postal_code" value="{{ $user->user_postal_code }}" placeholder="00000">
                                        </div>             
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-form"> 
                        <div class="row m-0">
                            <div class="col-lg-3 card-body">
                                <p><strong class="headings-color">Permissions.</strong></p>
                            </div>
                            <div class="col-lg-9 card-form__body card-body">                
                                <div class="form-group">
                                    @php
                                        $prArray = [];
                                        foreach($user->permission as $pr) {
                                            $prArray[] = $pr->permission_id;
                                        }
                                    @endphp
                                    @foreach($permissions as $permission)
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" <?php if(in_array($permission->permission_id, $prArray)){ echo 'checked'; } ?> class="custom-control-input" name="permission[]" id="pr{{ $permission->permission_id }}" value="{{ $permission->permission_id }}">
                                        <label class="custom-control-label" for="pr{{ $permission->permission_id }}">{{ ucfirst($permission->permission_name) }}</label>
                                    </div>
                                    @endforeach
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
                                    <textarea class="form-control @error('user_details') is-invalid @enderror" name="user_details" value="{{ $user->user_details }}" placeholder="Description" rows="5">{{ $user->user_details }}</textarea>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-lg-4 card-body">
                                <p><strong class="headings-color">User Photo</strong></p>
                                <p class="text-muted">The file must be an image like jpeg, png, bmp, svg, or webp</p>
                            </div>
                            <div class="col-lg-8 card-form__body card-body d-flex align-items-center">
                                <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                    <ul class="dz-preview dz-preview-multiple list-group list-group-flush">
                                        @if($user->user_image == null)
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
                                                        <img src="{{ asset('uploads/images/users/').'/'.$user->user_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
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
                                        <input type="hidden" name="user_old_image" value="{{ $user->user_image }}">
                                        <input type="file" name="user_image" id="user_image" class="form-control file" />
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