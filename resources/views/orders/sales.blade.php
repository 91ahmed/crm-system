@extends('layouts.app')
@section('title', 'Sales')

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
                                aria-current="page">Sales</li>
                        </ol>
                        </div>
                        <h4 class="page-title">Sales</h4>
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
                                                    <th>Status</th>
                                                    <th><div style="width:150px;">Date</div></th>
                                                    <th>View</th>
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
                                                    <th></th>
                                                    <th>
                                                        <input type="date" class="form-control dbcolumn" data-column="7">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff">
                                                @foreach($sales as $order)
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
                                                    <td><span class="badge badge-success">{{ ucwords($order->orderStatus->order_status_name) }}</span></td>
                                                    <td>{{ $order->order_created }}</td>
                                                    <td>
                                                        <a href="{{ url('invoice/order').'/'.$order->order_id }}" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Print Invoice" data-original-title="Update">
                                                        Invoice
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Danger Alert Modal -->
                                        <div id="modal-delete" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
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
    
    @include('layouts/footer')

@endsection