@extends('layouts.app')
@section('title', 'Companies')

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
                                aria-current="page">Companies</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Companies</h4>
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
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-company">
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

                                    <form action="{{ url('delete/company') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <table class="table mb-0 thead-border-top-0" id="dbtable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 18px;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="check_all">
                                                            <label class="custom-control-label" for="check_all"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </th>

                                                    <th>Name</th>
                                                    <th>E-mail</th>
                                                    <th>Phone</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allCompanies as $company)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $company->company_id }}" name="company_id[]" value="{{ $company->company_id }}">
                                                            <label class="custom-control-label" for="check{{ $company->company_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <div class="media-body">
                                                                <span class="js-lists-values-employee-name">{{ $company->company_name }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $company->company_email }}</td>
                                                    <td>
                                                        @if($company->company_phone == null)
                                                        <small class="text-muted">
                                                        ----
                                                        <br/>
                                                        {{ $company->country->country_name }}
                                                        </small>
                                                        @else
                                                        <small class="text-muted">
                                                            +({{ $company->country->country_code }}) {{ $company->company_phone }}
                                                            <br/>
                                                            {{ $company->country->country_name }}
                                                        </small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('profile/company').'/'.$company->company_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('update/company').'/'.$company->company_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
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
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-body text-center p-4">
                                                        <i class="fas fa-exclamation-triangle" style="font-size: 30px;"></i>
                                                        <h4 class="text-white">Warning!</h4>
                                                        <p class="text-white mt-3">Are you sure you want to delete this data permanently?</p>
                                                        <button type="submit"
                                                                class="btn btn-light my-2"
                                                                >Yes, continue</button>
                                                        <button type="button" class="btn btn-light my-2" data-dismiss="modal">Cancel</button>
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
            <div id="modal-company" class="modal bs-example-modal-lg">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Company</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <div class="row no-gutters">       
                                <form action="{{ url('add/company/request') }}" class="ajax-form" data-redirect="{{ url('companies') }}" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: left;">
                                    @csrf
                                    <div class="card card-form">
                                        <div class="card-header">
                                            <p><strong class="headings-color">Company Info</strong></p>
                                        </div>
                                        <div class="card-form__body card-body"> 
                                            <div class="form-group">
                                                <label for="company_name">Name: <span class="red-req">*</span></label>
                                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="lead_email">E-mail:</label>
                                                <input type="email" class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" value="{{ old('company_email') }}" placeholder="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="lead_email">Industry:</label>
                                                <input type="text" class="form-control @error('company_industry') is-invalid @enderror" id="company_industry" name="company_industry" value="{{ old('company_industry') }}" placeholder="industry">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="company_address">Address:</label>
                                                        <input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" value="{{ old('company_address') }}" placeholder="123 Main Street, New York, NY 10030">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4 form-group">
                                                        <label for="company_city">City:</label>
                                                        <input type="text" class="form-control @error('company_city') is-invalid @enderror" id="company_city" name="company_city" value="{{ old('company_city') }}" placeholder="city">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="company_region">Region:</label>
                                                        <input type="text" class="form-control @error('company_region') is-invalid @enderror" id="company_region" name="company_region" value="{{ old('company_region') }}" placeholder="region">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="company_country">Country: <span class="red-req">*</span></label>
                                                        <select class="form-control selectpicker-search" name="company_country" id="company_country">
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
                                                        <label for="company_phone">Phone:</label>
                                                        <input type="text" class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" value="{{ old('company_phone') }}" placeholder="01069200923">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="company_fax">Fax:</label>
                                                        <input type="text" class="form-control @error('company_fax') is-invalid @enderror" id="company_fax" name="company_fax" value="{{ old('company_fax') }}" placeholder="+1 (xxx) xxx-xxxx">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label for="company_website">Website:</label>
                                                        <input type="text" class="form-control @error('company_website') is-invalid @enderror" id="company_website" name="company_website" value="{{ old('company_website') }}" placeholder="91ahmed.github.io">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <label for="company_postal_code">Postal Code:</label>
                                                        <input type="text" class="form-control @error('company_postal_code') is-invalid @enderror" id="company_postal_code" name="company_postal_code" value="{{ old('company_postal_code') }}" placeholder="00000">
                                                    </div>             
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="card card-form">
                                        <div class="card-header">
                                            <p><strong class="headings-color">Other Details</strong></p>
                                        </div>
                                        <div class="card-form__body card-body">                
                                            <div class="form-group">
                                                <textarea class="form-control @error('company_details') is-invalid @enderror" name="company_details" value="{{ old('company_details') }}" placeholder="Details" rows="5"></textarea>
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