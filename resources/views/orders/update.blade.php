@extends('layouts.app')
@section('title', 'Update Order')

@section('content')
    
    @include('layouts/header')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">Home</i></a></li>
                            <li class="breadcrumb-item">Orders</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Update</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Update Order</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @foreach($orderData as $order)
            <div>       
                <form action="{{ url('update/order/request') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                    <div class="card card-form">
                        <div class="card-header">
                            <p><strong class="headings-color">Order Info</strong></p>
                        </div>
                        <div class="card-form__body card-body"> 
                            <div class="form-group">
                                <label>Lead:</label>
                                <select class="form-control dbcolumn selectpicker-search" name="order_lead" data-column="2">
                                    <option value="{{ $order->order_lead }}" selected>- {{ $order->lead->lead_full_name }} -</option>
                                    @foreach($leads as $lead)
                                    <option value="{{ $lead->lead_id }}">{{ $lead->lead_full_name }}</option>
                                    @endforeach
                                    <option value="">- NULL -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product:</label>
                                <select class="form-control dbcolumn selectpicker-search" name="order_product" data-column="2">
                                    <option value="{{ $order->order_product }}" selected>- {{ $order->product->product_name }} -</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                    <option value="">- NULL -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control dbcolumn selectpicker-search" name="order_status" data-column="2">
                                    <option value="{{ $order->order_status }}" selected>- {{ $order->orderStatus->order_status_name }} - </option>
                                    @foreach($ordersStatus as $st)
                                    <option value="{{ $st->order_status_id }}">{{ $st->order_status_name }}</option>
                                    @endforeach
                                    <option value="">- NULL -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_address">Address:</label>
                                <input type="text" class="form-control" value="{{ $order->order_address }}" name="order_address" placeholder="751 Green Hill Dr. Webster, NY 14580">
                            </div>
                            <div class="form-group">
                                <label for="order_phone">Phone:</label>
                                <input type="text" class="form-control" value="{{ $order->order_phone }}" name="order_phone" placeholder="00000000000">
                            </div>
                            <div class="form-group">
                                <label for="order_quantity">Quantity:</label>
                                <input type="number" class="form-control" name="order_quantity" value="{{ $order->order_quantity }}" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="order_details" rows="4" placeholder="..." value="{{ $order->order_details }}">{{ $order->order_details }}</textarea>
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