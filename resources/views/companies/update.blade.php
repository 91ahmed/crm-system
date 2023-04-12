@extends('layouts.app')
@section('title', 'Update Company')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Companies</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Company</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($companies as $company)
            <div>       
                <form action="{{ url('update/company/request') }}" class="ajax-form" data-redirect="update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="company_id" value="{{ $company->company_id }}">
                    <div class="card">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body d-flex align-items-center">
                                <div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col">
                                                    <div class="font-weight-bold" data-dz-name="">{{ ucwords($company->company_name) }}</div>
                                                    <p class="small text-muted mb-0"><strong>{{ $company->company_industry }}</strong></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body"> 
                                <div class="form-group">
                                    <label for="company_name">Name: <span class="red-req">*</span></label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ $company->company_name }}" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="lead_email">E-mail:</label>
                                    <input type="email" class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" value="{{ $company->compnay_email }}" placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="lead_email">Industry:</label>
                                    <input type="text" class="form-control @error('company_industry') is-invalid @enderror" id="company_industry" name="company_industry" value="{{ $company->company_industry }}" placeholder="industry">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="company_address">Address:</label>
                                            <input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" value="{{ $company->company_address }}" placeholder="123 Main Street, New York, NY 10030">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label for="company_city">City:</label>
                                            <input type="text" class="form-control @error('company_city') is-invalid @enderror" id="company_city" name="company_city" value="{{ $company->company_city }}" placeholder="city">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="company_region">Region:</label>
                                            <input type="text" class="form-control @error('company_region') is-invalid @enderror" id="company_region" name="company_region" value="{{ $company->company_region }}" placeholder="region">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="company_country">Country: <span class="red-req">*</span></label>
                                            <select class="form-control selectpicker-search" name="company_country" id="company_country">
                                                <option value="{{ $company->company_country }}" selected="">{{ $company->country->country_name }}</option>
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
                                            <input type="text" class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" value="{{ $company->company_phone }}" placeholder="01069200923">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="company_fax">Fax:</label>
                                            <input type="text" class="form-control @error('company_fax') is-invalid @enderror" id="company_fax" name="company_fax" value="{{ $company->company_fax }}" placeholder="+1 (xxx) xxx-xxxx">
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="company_website">Website:</label>
                                            <input type="text" class="form-control @error('company_website') is-invalid @enderror" id="company_website" name="company_website" value="{{ $company->company_website }}" placeholder="91ahmed.github.io">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="company_postal_code">Postal Code:</label>
                                            <input type="text" class="form-control @error('company_postal_code') is-invalid @enderror" id="company_postal_code" name="company_postal_code" value="{{ $company->company_postal_code }}" placeholder="00000">
                                        </div>             
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card"> 
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body">                
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control @error('company_details') is-invalid @enderror" name="company_details" value="{{ $company->company_details }}" placeholder="Description" rows="5">{{ $company->company_details }}</textarea>
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