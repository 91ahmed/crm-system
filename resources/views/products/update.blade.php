@extends('layouts.app')
@section('title', 'Update Product')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Products</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Product</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($allProducts as $product)
            <div class="row no-gutters">       
                <form action="{{ url('update/product/request') }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body d-flex align-items-center">
                                <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                    <ul class="dz-preview dz-preview-multiple list-group list-group-flush">
                                        @if($product->product_image == null)
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img src="{{ asset('assets/images/item.jpg') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-bold" data-dz-name="">{{ ucwords($product->product_name) }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        @else
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img src="{{ asset('uploads/images/products/').'/'.$product->product_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-bold" data-dz-name="">{{ ucwords($product->product_name) }}</div>
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
                            <div class="col-12 card-form__body card-body"> 
                                <div class="row">               
                                    <div class="form-group col-12">
                                        <label for="product_name">Name: <span class="red-req">*</span></label>
                                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ $product->product_name }}" placeholder="product name">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="product_price">Price: <span class="red-req">*</span></label>
                                        <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" value="{{ $product->product_price }}" placeholder="product price">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="product_quantity">Quantity: <span class="red-req">*</span></label>
                                        <input type="text" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}" placeholder="product quantity">
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-form"> 
                        <div class="row m-0">
                            <div class="col-12 card-form__body card-body">                
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control @error('product_details') is-invalid @enderror" id="summernote-editor" name="product_details" value="{{ $product->product_details }}" placeholder="Details" rows="6">{{ $product->product_details }}</textarea>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-form">
                        <div class="row m-0">
                            <div class="col-lg-4 card-body">
                                <p><strong class="headings-color">Product Photo</strong></p>
                                <p class="text-muted">The file must be an image like jpeg, png, bmp, svg, or webp</p>
                            </div>
                            <div class="col-lg-8 card-form__body card-body d-flex align-items-center">
                                <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                    <ul class="dz-preview dz-preview-multiple list-group list-group-flush">
                                        @if($product->product_image == null)
                                        <li class="list-group-item dz-success">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img src="{{ asset('assets/images/item.jpg') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
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
                                                        <img src="{{ asset('uploads/images/products/').'/'.$product->product_image }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
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
                                        <input type="hidden" name="product_old_image" value="{{ $product->product_image }}">
                                        <input type="file" name="product_image" id="product_image" class="form-control file" />
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