@extends('layouts.app')
@section('title', 'Campaigns')

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
                                aria-current="page">Campaigns</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Campaigns</h4>
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
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-campaign">
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

                                    <form action="{{ url('delete/campaign') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <table class="table mb-0 table-hover thead-border-top-0 dataTable" id="dbtable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 18px;">
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input" id="check_all">
                                                            <label class="custom-control-label" for="check_all"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </th>
                                                    <th><div style="width:100px;">Name</div></th>
                                                    <th><div style="width:100px;">Start Date</div></th>
                                                    <th><div style="width:100px;">End Date</div></th>
                                                    <th><div style="width:150px;">Created Date</div></th>
                                                    <th><div style="width:150px;">Assigned to</div></th>
                                                    <th><div style="width:100px;">Options</div></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search name" data-column="1">
                                                    </th>
                                                    <th>
                                                        <input type="date" class="form-control dbcolumn" placeholder="start date" data-column="2">
                                                    </th>
                                                    <th>
                                                        <input type="date" class="form-control dbcolumn" placeholder="end date" data-column="3">
                                                    </th>
                                                    <th></th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-search" data-column="6">
                                                            <option value="" selected>- select user -</option>
                                                            @foreach($users as $user)
                                                            <option value="{{ $user->user_full_name }}">{{ $user->user_full_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allCampaigns as $campaign)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $campaign->campaign_id }}" name="campaign_id[]" value="{{ $campaign->campaign_id }}">
                                                            <label class="custom-control-label" for="check{{ $campaign->campaign_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $campaign->campaign_name }}
                                                    </td>
                                                    <td>
                                                        {{ $campaign->campaign_start }}
                                                    </td>
                                                    <td>
                                                        {{ $campaign->campaign_end }}
                                                    </td>
                                                    <td>
                                                        {{ $campaign->campaign_created }}
                                                    </td>
                                                    <td>
                                                        {{ $campaign->user->user_full_name }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('profile/campaign').'/'.$campaign->campaign_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('update/campaign').'/'.$campaign->campaign_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
                                                        <i class="fas fa-wrench"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Danger Alert Modal -->
                                        <div id="modal-delete" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
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

            <!-- Modal Campaign -->
            <div id="modal-campaign" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Campaign</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">

                            <div class="row no-gutters">       
                        <form action="{{ url('add/campaign/request') }}" method="POST" enctype="multipart/form-data" class="ajax-form" data-redirect="{{ url('campaigns') }}" style="width: 100%;">
                            @csrf
                            <div class="card card-form">
                                <div class="row m-0">
                                    <div class="col-12 card-form__body card-body">                
                                        <div class="form-group">
                                            <label for="campaign_name">Name: <span class="red-req">*</span></label>
                                            <input type="text" class="form-control @error('campaign_name') is-invalid @enderror" id="campaign_name" name="campaign_name" value="{{ old('campaign_name') }}" placeholder="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="campaign_start">Start Date: <span class="red-req">*</span></label>
                                            <input type="date" class="form-control @error('campaign_start') is-invalid @enderror" id="campaign_start" name="campaign_start">
                                        </div>
                                        <div class="form-group">
                                            <label for="campaign_end">End Date: <span class="red-req">*</span></label>
                                            <input type="date" class="form-control @error('campaign_end') is-invalid @enderror" id="campaign_end" name="campaign_end">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="card card-form"> 
                                <div class="row m-0">
                                    <div class="col-12 card-form__body card-body">                
                                        <div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control @error('campaign_details') is-invalid @enderror" name="campaign_details" id="summernote-editor" value="{{ old('campaign_details') }}" placeholder="Details" rows="5"></textarea>
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
                            </div>

                        </div> <!-- // END .modal-body -->
                    </div> <!-- // END .modal-content -->
                </div> <!-- // END .modal-dialog -->
            </div> <!-- // END .modal -->

    @include('layouts/footer')

@endsection