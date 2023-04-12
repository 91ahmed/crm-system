@extends('layouts.app')
@section('title', 'Products')

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
                                aria-current="page">Products</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Products</h4>
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
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-product">
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

                                    <form action="{{ url('delete/product') }}" method="POST">
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
                                                    <th>Image</th>
                                                    <th>SKU</th>
                                                    <th><div style="width:250px;">Name</div></th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th><div style="width:100px;">Options</div></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search sku" data-column="2">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="search name" data-column="3">
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allProducts as $product)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control checkbox checkbox-danger">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $product->product_id }}" name="product_id[]" value="{{ $product->product_id }}">
                                                            <label class="custom-control-label" for="check{{ $product->product_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <div class="avatar avatar-xs mr-2">
                                                                @if($product->product_image == NULL)
                                                                <img src="{{ asset('assets/images/item.jpg') }}" alt="Avatar" class="avatar-img rounded-circle">
                                                                @else
                                                                <img src="{{ asset('uploads/images/products/').'/'.$product->product_image }}" alt="Avatar" class="avatar-img rounded-circle">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $product->product_sku }}
                                                    </td>
                                                    <td>
                                                        {{ $product->product_name }}
                                                    </td>
                                                    <td>${{ number_format($product->product_price, 2) }}</td>
                                                    <td>{{ $product->product_quantity }}</td>
                                                    <td>
                                                        <a href="{{ url('profile/product').'/'.$product->product_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Preview" data-original-title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('update/product').'/'.$product->product_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
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

            <!-- Modal Product -->
            <div id="modal-product" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">

                            <div class="row no-gutters">       
                        <form action="{{ url('add/product/request') }}" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            @csrf
                            <input type="hidden" name="product_sku" value="{{ substr(md5(microtime()),rand(0,26),12) }}"/>
                            <div class="card card-form">
                                <div class="row m-0">
                                    <div class="col-12 card-form__body card-body">                
                                        <div class="form-group">
                                            <label for="product_name">Name: <span class="red-req">*</span></label>
                                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" placeholder="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_price">Price: <span class="red-req">*</span></label>
                                            <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" placeholder="000.00" value="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_quantity">Quantity: <span class="red-req">*</span></label>
                                            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" name="product_quantity" placeholder="Quantity" value="1">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="card card-form"> 
                                <div class="row m-0">
                                    <div class="col-12 card-form__body card-body">                
                                        <div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control @error('product_details') is-invalid @enderror" name="product_details" id="summernote-editor" value="{{ old('product_details') }}" placeholder="Details" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="card card-form">
                                <div class="row m-0">
                                    <div class="col-lg-4 card-body">
                                        <p><strong class="headings-color">Product Image</strong></p>
                                        <p class="text-muted">The file must be an image like jpeg, png, bmp, svg, or webp</p>
                                    </div>
                                    <div class="col-lg-8 card-form__body card-body d-flex align-items-center">
                                        <div data-toggle="dropzone" data-dropzone-multiple="" data-dropzone-url="http://" data-dropzone-files="[&quot;assets/images/avatar/blue.svg&quot;, &quot;assets/images/avatar/demi.png&quot;, &quot;assets/images/avatar/green.svg&quot;]">
                                            <ul class="dz-preview dz-preview-multiple list-group list-group-flush"><li class="list-group-item dz-success dz-complete">
                                                    <div class="form-row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/images/item.jpg') }}" class="avatar-img rounded filepreview" alt="..." data-dz-thumbnail="">
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
                                            <input type="file" name="product_image" id="product_image" class="form-control file" />
                                            <button class="btn btn-warning dz-button file-trigger" type="button">Choose files to upload</button>
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

                        </div> <!-- // END .modal-body -->
                    </div> <!-- // END .modal-content -->
                </div> <!-- // END .modal-dialog -->
            </div> <!-- // END .modal -->

    @include('layouts/footer')

@endsection