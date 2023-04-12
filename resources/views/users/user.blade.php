@extends('layouts.app')
@section('title', 'Users')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Users</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Users</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="mb-3">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-light btn-sm modal-delete" data-toggle="modal" data-target="#modal-delete">
                            <span class="fas fa-trash"></span> Delete
                        </button>
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-user">
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

                                    <form action="{{ url('delete/user') }}" method="POST">
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
                                                    <th class="th-search"><div style="width:150px">Name</div></th>
                                                    <th class="th-search">E-mail</th>
                                                    <th class="th-search">Role</th>
                                                    <th><div style="width:100px">Options</div></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search name" data-column="2">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search e-mail" data-column="3">
                                                    </th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-default" data-column="4">
                                                            <option value="" selected>- select role -</option>
                                                            @foreach($roles as $role)
                                                            <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allUsers as $user)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $user->user_id }}" name="user_id[]" value="{{ $user->user_id }}">
                                                            <label class="custom-control-label" for="check{{ $user->user_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <div class="avatar avatar-xs mr-2">
                                                                @if($user->user_image == NULL)
                                                                <img src="{{ asset('assets/images/avatar.png') }}" alt="Avatar" class="avatar-img rounded-circle">
                                                                @else
                                                                <img src="{{ asset('uploads/images/users/').'/'.$user->user_image }}" alt="Avatar" class="avatar-img rounded-circle">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $user->user_full_name }}
                                                        @if($user->user_id == auth::user()->user_id)
                                                        <span class="badge badge-danger">You</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if($user->user_role == 1)
                                                        <span class="badge badge-warning">
                                                        @elseif($user->user_role == 2)
                                                        <span class="badge badge-info">
                                                        @elseif($user->user_role == 3)
                                                        <span class="badge badge-primary">
                                                        @elseif($user->user_role == 4)
                                                        <span class="badge badge-success">
                                                        @elseif($user->user_role == 5)
                                                        <span class="badge badge-danger">
                                                        @elseif($user->user_role == 6)
                                                        <span class="badge badge-dark">
                                                        @elseif($user->user_role == 7)
                                                        <span class="badge badge-light">
                                                        @else
                                                        <span class="badge badge-default">
                                                        @endif
                                                            {{ ucwords($user->role->role_name) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('profile/user').'/'.$user->user_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('update/user').'/'.$user->user_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
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

            <!-- Modal User -->
            <div id="modal-user" class="modal bs-example-modal-lg">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">

                            <div class="row no-gutters">       
                                <form action="{{ url('add/user/request') }}" method="POST" class="ajax-form" data-redirect="{{ url('users') }}" enctype="multipart/form-data" style="width: 100%; text-align: left !important;">
                                @csrf
                                <div class="card card-form">
                                    <div class="card-header">
                                        Login Info.
                                    </div>
                                    <div class="card-form__body card-body">                
                                        <div class="form-group">
                                            <label for="email">E-mail: <span class="red-req">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password: <span class="red-req">*</span></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="xxxxxxxx">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password: <span class="red-req">*</span></label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                                        </div>
                                    </div> 
                                </div>
                                <div class="card card-form">
                                    <div>
                                        <div class="card-header">
                                            Personal Info
                                        </div>
                                        <div class="card-form__body card-body">
                                            <div class="form-group">
                                                <label for="user_first_name">First name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('user_first_name') is-invalid @enderror" id="user_first_name" name="user_first_name" value="{{ old('user_first_name') }}" placeholder="first name">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_last_name">last name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('user_last_name') is-invalid @enderror" id="user_last_name" name="user_last_name" value="{{ old('user_last_name') }}" placeholder="last name">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_full_name">Full name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('user_full_name') is-invalid @enderror" id="user_full_name" name="user_full_name" value="{{ old('user_full_name') }}" placeholder="full name">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label>Gender: <span class="red-req">*</span></label>
                                                        <select class="form-control selectpicker-default @error('user_gender') is-invalid @enderror" name="user_gender">
                                                            <option value="" selected="">-Gender-</option>
                                                            @foreach($genders as $gender)
                                                            <option value="{{ $gender->gender_id }}">{{ $gender->gender_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label>Role: <span class="red-req">*</span></label>
                                                        <select class="form-control selectpicker-default @error('user_role') is-invalid @enderror" name="user_role">
                                                            <option value="" selected="">-Role-</option>
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
                                                            <option value="" selected="">Day</option>
                                                            @for($day = 1; $day <= 31; $day++)
                                                            <option value="{{ $day }}">{{ $day }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <select class="form-control selectpicker-default" name="user_birth_month">
                                                            <option value="" selected="">Month</option>
                                                            @for($month = 1; $month <= 12; $month++)
                                                            <option value="{{ $month }}">{{ $month }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <select class="form-control selectpicker-search" name="user_birth_year">
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
                                                        <label for="user_address">Address:</label>
                                                        <input type="text" class="form-control @error('user_address') is-invalid @enderror" id="user_address" name="user_address" value="{{ old('user_address') }}" placeholder="123 Main Street, New York, NY 10030">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4 form-group">
                                                        <label for="user_city">City:</label>
                                                        <input type="text" class="form-control @error('user_city') is-invalid @enderror" id="user_city" name="user_city" value="{{ old('user_city') }}" placeholder="city">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="user_region">Region:</label>
                                                        <input type="text" class="form-control @error('user_region') is-invalid @enderror" id="user_region" name="user_region" value="{{ old('user_region') }}" placeholder="region">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="user_country">Country: <span class="red-req">*</span></label>
                                                        <select class="form-control selectpicker-search" name="user_country" id="user_country">
                                                            <option value="" selected="">-Country-</option>
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
                                                        <input type="text" class="form-control @error('user_phone') is-invalid @enderror" id="user_phone" name="user_phone" value="{{ old('user_phone') }}" placeholder="01069200923">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="user_fax">Fax:</label>
                                                        <input type="text" class="form-control @error('user_fax') is-invalid @enderror" id="user_fax" name="user_fax" value="{{ old('user_fax') }}" placeholder="+1 (xxx) xxx-xxxx">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="user_website">Website:</label>
                                                        <input type="text" class="form-control @error('user_website') is-invalid @enderror" id="user_website" name="user_website" value="{{ old('user_website') }}" placeholder="91ahmed.github.io">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <label for="user_postal_code">Postal Code:</label>
                                                        <input type="text" class="form-control @error('user_postal_code') is-invalid @enderror" id="user_postal_code" name="user_postal_code" value="{{ old('user_postal_code') }}" placeholder="00000">
                                                    </div>             
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="card card-form">
                                    <div class="card-header">
                                        Permissions
                                    </div>
                                    <div class="card-form__body card-body">          
                                        <div class="form-group">
                                            @foreach($permissions as $permission)
                                            <div class="custom-control custom-checkbox mt-1">
                                                <input type="checkbox" class="custom-control-input" id="pr{{ $permission->permission_id }}" name="permission[]" value="{{ $permission->permission_id }}">
                                                <label class="custom-control-label" for="pr{{ $permission->permission_id }}">{{ ucfirst($permission->permission_name) }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-form">
                                    <div class="card-header">
                                        Details
                                    </div>
                                    <div class="card-form__body card-body">                
                                        <div class="form-group">
                                            <textarea class="form-control @error('user_details') is-invalid @enderror" name="user_details" value="{{ old('user_details') }}" placeholder="write something.." rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-form">
                                    <div>
                                        <div class="card-header">
                                            <p><strong class="headings-color">Photo</strong></p>
                                            <p class="text-muted">The file must be an image like jpeg, png, jpg</p>
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
                                            </div>
                                            <div>
                                                <input type="file" name="user_image" id="user_image" class="form-control file" />
                                                <button class="btn btn-warning dz-button file-trigger" type="button">Choose files to upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-form">
                                    <div class="card-form__body card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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