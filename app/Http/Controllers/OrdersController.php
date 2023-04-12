<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;

class OrdersController extends Controller
{
    public function index (Request $request)
    {   
        $allOrders = Order::with('lead','product', 'orderStatus')->orderBy('order_id', 'DESC')->get();
        $ordersStatus = OrderStatus::all();

        return view('orders/order', compact('allOrders', 'ordersStatus'));
    }

    public function sales (Request $request)
    {   
        $sales = Order::join('orders_status', 'orders_status.order_status_id', '=', 'orders.order_status')
        				  ->where('orders_status.order_status_name', '=', 'delivered')
        				  ->orderBy('order_id', 'DESC')
        				  ->get();

        return view('orders/sales', compact('sales'));
    }

    public function add (Request $request)
    {
        $id = Order::max('order_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'order_lead' => ['required', 'numeric'],
    		'order_product' => ['required', 'numeric'],
    		'order_quantity' => ['required', 'numeric'],
    		'order_status' => ['required', 'numeric'],
    		'order_details' => ['nullable', 'string'],
    		'order_address' => ['required', 'string'],
    		'order_phone' => ['required', 'string'],
    	]);

    	// Insert Date
    	$order = new Order;
        $order->order_id = $id;
    	$order->order_lead = $request->input('order_lead');
    	$order->order_product = $request->input('order_product');
    	$order->order_quantity = $request->input('order_quantity');
    	$order->order_status = $request->input('order_status');
    	$order->order_details = $request->input('order_details');
    	$order->order_address = $request->input('order_address');
    	$order->order_phone = $request->input('order_phone');
    	$order->save();

        session()->flash('save', 'Your data has been saved successfuly.');

    	if(!$request->ajax()){
    		return redirect()->back();
    	}
    }

    public function delete (Request $request)
    {
        $orders = $request->input('order_id');

        // Delete order from database
        Order::destroy($orders);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('orders');
        }
    }

    public function updatePage ($id)
    {  
        $orderData = Order::with('lead', 'product', 'orderStatus')
                     ->where('order_id', '=', $id)
                     ->get();

        $ordersStatus = OrderStatus::all();

        return view('orders/update', compact('orderData', 'ordersStatus'));
    }

    public function update (Request $request)
    {
        $orderId = $request->input('order_id');

        // Validation
        $validatedData = $request->validate([
    		'order_lead' => ['required', 'numeric'],
    		'order_product' => ['required', 'numeric'],
    		'order_quantity' => ['required', 'numeric'],
    		'order_status' => ['required', 'numeric'],
    		'order_details' => ['nullable', 'string'],
    		'order_address' => ['required', 'string'],
    		'order_phone' => ['required', 'string'],
        ]);

        // Update Date
        $order = Order::where('order_id', $orderId)->first();
        $order->order_lead = $request->input('order_lead');
    	$order->order_product = $request->input('order_product');
    	$order->order_quantity = $request->input('order_quantity');
    	$order->order_status = $request->input('order_status');
    	$order->order_details = $request->input('order_details');
    	$order->order_address = $request->input('order_address');
    	$order->order_phone = $request->input('order_phone');
    	$order->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function invoice ($id)
    {
    	$invoice = Order::with('lead', 'product', 'orderStatus')
                     ->where('order_id', '=', $id)
                     ->first();

        $ordersStatus = OrderStatus::all();

    	return view('orders/invoice', compact('invoice', 'ordersStatus'));
    }

    public function changeOrderStatus (Request $request)
    {
    	$orderId = $request->input('order_id');

    	$order = Order::where('order_id', $orderId)->first();
    	$order->order_status = $request->input('order_status');
    	$order->save();

    	if(!$request->ajax()){
            return redirect()->back();
        }
    }
}
