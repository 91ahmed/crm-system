@extends('layouts.app')
@section('title', 'Product Profile')

@section('content')
    
    @include('layouts/header')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
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
                            @if($product->product_image == null)
                            <img src="{{ asset('assets/images/item.jpg') }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @else
                            <img src="{{ asset('uploads/images/products/').'/'.$product->product_image }}"alt="avatar" class="rounded-circle avatar-lg img-thumbnail" style="border: 2px solid white;">
                            @endif

                            <h4 class="mb-0">{{ ucwords($product->product_name) }}</h4>
                            <br/>

                            <a href="{{ url('update/product/').'/'.$product->product_id }}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Edit</a>
                            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light" data-toggle="modal" data-target="#modal-delete">Delete</button>

                            <div class="text-left mt-3">
                                <p class="text-muted mb-2 font-13"><strong>Price :</strong> <span class="ml-2">$ {{ $product->product_price }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Quantity :</strong> <span class="ml-2">{{ $product->product_quantity }}</span></p>
                            </div>

                        </div> <!-- end card-box -->

                        @if($product->product_image !== null)
                        <div class="card-box">
                            <div class="card-head">
                                <h4 class="header-title mb-3">Image</h4>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('uploads/images/products/').'/'.$product->product_image }}" style="width: 100%;">
                            </div>
                        </div>
                        @endif

                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">

                        <div class="card-box">
                            <div class="card-head">
                                <h4 class="header-title mb-3">Details</h4>
                            </div>
                            <div class="card-body">
                                {!! $product->product_details !!}
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
                                <form action="{{ url('delete/product') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
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