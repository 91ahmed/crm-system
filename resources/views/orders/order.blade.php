@extends('layouts.app')
@section('title', 'Orders')

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
                                aria-current="page">Orders</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Orders</h4>
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
                        <a href="#" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal-order">
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

                                    <form action="{{ url('delete/order') }}" method="POST">
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
                                                    <th>Invoice</th>
                                                    <th><div style="width:150px;">Lead</div></th>
                                                    <th>SKU</th>
                                                    <th><div style="width:200px;">Product</div></th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th><div style="width:150px;">Date</div></th>
                                                    <th>View</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>
                                                        <input type="number" class="form-control dbcolumn" placeholder="Invoice" data-column="1">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="Lead" data-column="2">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="SKU" data-column="3">
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control dbcolumn" placeholder="Product" data-column="4">
                                                    </th>
                                                    <th></th>
                                                    <th>
                                                        <select class="form-control dbcolumn selectpicker-search" name="order_status" data-column="6">
                                                            <option value="" selected>- status -</option>
                                                            @foreach($ordersStatus as $st)
                                                            <option value="{{ $st->order_status_name }}">{{ $st->order_status_name }}</option>
                                                            @endforeach
                                                            <option value="">- NULL -</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="date" class="form-control dbcolumn" data-column="7">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($allOrders as $order)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input check" id="check{{ $order->order_id }}" name="order_id[]" value="{{ $order->order_id }}">
                                                            <label class="custom-control-label" for="check{{ $order->order_id }}"><span class="text-hide">Check</span></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <div class="media-body">
                                                                <span class="js-lists-values-employee-name">{{ $order->lead->lead_full_name }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $order->product->product_sku }}</td>
                                                    <td>{{ $order->product->product_name }}</td>
                                                    <td>{{ $order->order_quantity }}</td>
                                                    <td><span class="badge badge-dark">{{ ucwords($order->orderStatus->order_status_name) }}</span></td>
                                                    <td>{{ $order->order_created }}</td>
                                                    <td>
                                                        <a href="{{ url('invoice/order').'/'.$order->order_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Print Invoice" data-original-title="Update">
                                                        Invoice
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('update/order').'/'.$order->order_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Update" data-original-title="Update">
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

            <!-- Modal orders -->
            <div id="modal-order" class="modal bs-example-modal-lg">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Add Order</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <div class="row no-gutters">       
                                <form action="{{ url('add/order/request') }}" method="POST" class="ajax-form" data-redirect="{{ url('orders') }}" style="width: 100%; text-align: left;">
                                    @csrf
                                    <div class="card card-form">
                                        <div class="card-header">
                                            <p><strong class="headings-color">Order Info</strong></p>
                                        </div>
                                        <div class="card-form__body card-body"> 
                                            <div class="form-group">
                                                <label>Lead:</label>
                                                <select class="form-control selectpicker-search" name="order_lead">
                                                    <option value="" selected>- select lead -</option>
                                                    @foreach($leads as $lead)
                                                    <option value="{{ $lead->lead_id }}">{{ $lead->lead_full_name }}</option>
                                                    @endforeach
                                                    <option value="">- NULL -</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product:</label>
                                                <select class="form-control selectpicker-search" name="order_product">
                                                    <option value="" selected>- select product -</option>
                                                    @foreach($products as $product)
                                                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                                    @endforeach
                                                    <option value="">- NULL -</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <select class="form-control selectpicker-search" name="order_status">
                                                    <option value="1" selected># Pending</option>
                                                    @foreach($ordersStatus as $st)
                                                    <option value="{{ $st->order_status_id }}">{{ $st->order_status_name }}</option>
                                                    @endforeach
                                                    <option value="">- NULL -</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="order_address">Address:</label>
                                                <input type="text" class="form-control" name="order_address" placeholder="751 Green Hill Dr. Webster, NY 14580">
                                            </div>
                                            <div class="form-group">
                                                <label for="order_phone">Phone:</label>
                                                <input type="text" class="form-control" name="order_phone" placeholder="00000000000">
                                            </div>
                                            <div class="form-group">
                                                <label for="order_quantity">Quantity:</label>
                                                <input type="number" class="form-control" name="order_quantity" value="1" placeholder="Quantity">
                                            </div>
                                            <div class="form-group">
                                                <label>Details</label>
                                                <textarea class="form-control" name="order_details" rows="4" placeholder="...">...</textarea>
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