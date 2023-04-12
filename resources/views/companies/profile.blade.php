@extends('layouts.app')
@section('title', 'Company Profile')

@section('content')
    
    @include('layouts/header')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Company</a></li>
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
                            <img src="{{ asset('assets/images/company.jpeg') }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">

                            <h4 class="mb-0">{{ $company->company_name }}</h4>
                            <p class="text-muted">{{ $company->company_industry }}</p>

                            <a href="{{ url('update/company/').'/'.$company->company_id }}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Edit</a>
                            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light" data-toggle="modal" data-target="#modal-delete">Delete</button>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Website" data-original-title="Website">
                                    <a href="{{ $company->company_website }}" target="_blank" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-earth"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Call" data-original-title="Call">
                                    <a href="tel: +{{ $company->country->country_code.''.$company->company_phone }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-phone"></i></a>
                                </li>
                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send E-mail" data-original-title="Send E-mail">
                                    <a href="mailto: {{ $company->company_email }}" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-email"></i></a>
                                </li>
                            </ul>

                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase">About Company :</h4>
                                <p class="text-muted font-13 mb-3">
                                    {{ $company->company_details }}
                                </p>
                                <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ml-2">{{ $company->company_name }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Industry :</strong> <span class="badge badge-info">{{ $company->company_industry }}</span></p>

                                @if($company->company_phone != '')
                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">+ ({{ $company->country->country_code }}) {{ $company->company_phone }}</span></p>
                                @endif

                                @if($company->company_fax != '')
                                <p class="text-muted mb-2 font-13"><strong>Fax :</strong><span class="ml-2">{{ $company->company_fax }}</span></p>
                                @endif

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $company->company_email }}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">
                                    {{ $company->country->country_name }}

                                    @if($company->company_city != '')
                                        , {{ $company->company_city }}
                                    @endif

                                    @if($company->company_region != '')
                                        , {{ $company->company_region }}
                                    @endif
                                </span>
                                </p>

                                @if($company->company_address != '')
                                <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2 ">{{ $company->company_address }}</span></p>
                                @endif

                                @if($company->company_website != '')
                                <p class="text-muted mb-2 font-13"><strong>Website :</strong> <span class="ml-2 ">{{ $company->company_website }}</span></p>
                                @endif
                                
                            </div>

                        </div> <!-- end card-box -->

                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">

                        <div class="card-box">
                            <h4 class="header-title mb-3">Leads ({{ $companyLeadsCount }})</h4>
                            <div class="inbox-widget slimscroll" style="max-height: 310px;">
                                @forelse($companyLeads as $lead)
                                <div class="inbox-item">
                                    <div class="inbox-item-img">
                                        @if($lead->lead_image == NULL)
                                        <img src="{{ asset('assets/images/avatar.png') }}" alt="Avatar" class="avatar-img rounded-circle">
                                        @else
                                        <img src="{{ asset('uploads/images/leads/').'/'.$lead->lead_image }}" alt="Avatar" class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <p class="inbox-item-author">{{ $lead->lead_full_name }}</p>
                                    <p class="inbox-item-text">{{ $lead->status->status_name }}</p>
                                    <p class="inbox-item-date">
                                        <a href="{{ url('profile/lead').'/'.$lead->lead_id }}" class="btn btn-sm btn-light text-info font-13"> Profile </a>
                                    </p>
                                </div>
                                @empty
                                <div class="inbox-item">
                                    <p class="inbox-item-text">No Leads</p>
                                </div>
                                @endforelse
                            </div>
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
                                <form action="{{ url('delete/company') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="company_id[]" value="{{ $company->company_id }}">
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