@extends('layouts.app')
@section('title', 'Invoice')

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
                                aria-current="page">Invoice</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Invoice</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <form action="{{ url('change/order/status') }}" method="POST" class="ajax-form d-print-none" data-redirect="update" style="width: 100%; margin-bottom: 20px;">
                @csrf
                <input type="hidden" name="order_id" value="{{ $invoice->order_id }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-12">
                        <label>Change Status</label>
                        <select class="form-control select-status selectpicker-search mb-3" name="order_status">
                            <option value="{{ $invoice->orderStatus->order_status_id }}" selected>- {{ $invoice->orderStatus->order_status_name }} -</option>
                            @foreach($ordersStatus as $st)
                            <option value="{{ $st->order_status_id }}">{{ $st->order_status_name }}</option>
                            @endforeach
                            <option value="">- NULL -</option>
                        </select>
                        <button type="submit" class="btn btn-info btn-sm">Change</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-left">
                                @include('layouts/logo')
                            </div>
                            <div class="float-right">
                                <h4 class="m-0 d-print-none">Invoice</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <p><b>Hello, {{ ucwords($invoice->lead->lead_first_name.' '.$invoice->lead->lead_last_name) }}</b></p>
                                    <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                        promises to provide high quality products for you as well as outstanding
                                        customer service for every transaction. </p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-md-right">
                                    <p><strong>Order Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; {{ substr($invoice->order_created, 0, strpos($invoice->order_created, ' ')) }}</span></p>
                                    <p><strong>Order Status : </strong> <span class="float-right"><span class="badge badge-dark select-status-val">{{ ucwords($invoice->orderStatus->order_status_name) }}</span></span></p>
                                    <p><strong>Invoice No. : </strong> <span class="float-right">{{ $invoice->order_id }} </span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6>Shipping Address</h6>
                                <address>
                                    {{ $invoice->order_address }}<br/>
                                    <abbr title="Phone">P:</abbr> {{ $invoice->order_phone }}
                                </address>
                            </div> <!-- end col -->

                            <!--
                            <div class="col-md-6">
                                <div class="text-md-right">
                                    <h6>Shipping Address</h6>
                                    <address>
                                        Stanley Jones<br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                            </div>
                            end col -->

                        </div> 
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                        <tr><th>#</th>
                                            <th>Item</th>
                                            <th style="width: 10%">Quantity</th>
                                            <th style="width: 10%">Price</th>
                                            <th style="width: 10%" class="text-right">Total</th>
                                        </tr></thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <b>{{ $invoice->product->product_name }}</b> <br>
                                                SKU: {{ $invoice->product->product_sku }}
                                            </td>
                                            <td>{{ $invoice->order_quantity }}</td>
                                            <td>${{ number_format($invoice->product->product_price, 2) }}</td>
                                            @php
                                                $total = number_format(totalPrice($invoice->order_quantity, $invoice->product->product_price));
                                            @endphp
                                            <td class="text-right">${{ $total }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h6 class="text-muted">Notes:</h6>

                                    <small class="text-muted">
                                        All accounts are to be paid within 7 days from receipt of
                                        invoice. To be paid by cheque or credit card or direct payment
                                        online. If account is not paid within 7 days the credits details
                                        supplied as confirmation of work undertaken will be charged the
                                        agreed quoted fee noted above.
                                    </small>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-right">
                                    <p><b>Tax:</b> <span class="float-right">0</span></p>
                                    <p><b>Discount (0%):</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; 0</span></p>
                                    <h3>${{ $total }} USD</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-right d-print-none">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                                <!--
                                <a href="#" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-send mr-1"></i> Submit</a>
                                -->
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>

    @include('layouts/footer')

@endsection