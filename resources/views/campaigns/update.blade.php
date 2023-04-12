@extends('layouts.app')
@section('title', 'Update Campaign')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Campaigns</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Campaign</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($allCampaigns as $campaign)
            <div class="row no-gutters">       
                <form action="{{ url('update/campaign/request') }}" method="POST" class="ajax-form" data-redirect="update" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="campaign_id" value="{{ $campaign->campaign_id }}">
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body">                
                                <div class="form-group">
                                    <label for="campaign_name">Name: <span class="red-req">*</span></label>
                                    <input type="text" class="form-control @error('campaign_name') is-invalid @enderror" id="campaign_name" name="campaign_name" value="{{ $campaign->campaign_name }}" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="campaign_start">Start Date: <span class="red-req">*</span></label>
                                    <input type="date" class="form-control @error('campaign_start') is-invalid @enderror" id="campaign_start" name="campaign_start" value="{{ $campaign->campaign_start }}">
                                </div>
                                <div class="form-group">
                                    <label for="campaign_end">End Date: <span class="red-req">*</span></label>
                                    <input type="date" class="form-control @error('campaign_end') is-invalid @enderror" id="campaign_end" name="campaign_end" value="{{ $campaign->campaign_end }}">
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-form"> 
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body">                
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control @error('campaign_details') is-invalid @enderror" name="campaign_details" id="summernote-editor" value="{{ $campaign->campaign_details }}" placeholder="Details" rows="5">{{ $campaign->campaign_details }}</textarea>
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