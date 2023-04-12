<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Auth;

class ProductController extends Controller
{
    public function index (Request $request)
    {   
        $allProducts = Product::orderBy('product_id', 'DESC')->with('user')->get();

        return view('products/product', compact('allProducts'));
    }

    public function add (Request $request)
    {
        // Product id
        $id = Product::max('product_id')+1;

    	// Validation
    	$validatedData = $request->validate([
    		'product_sku' => ['required', 'string', 'max:12'],
    		'product_name' => ['required', 'string', 'max:250'],
    		'product_price' => ['required', 'numeric'],
    		'product_quantity' => ['required', 'numeric'],
    		'product_details' => ['nullable', 'string'],
    		'product_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
    	]);

        // Upload Image
        $productImage = null;

        if($request->hasFile('product_image')) 
        {
            $file      = $request->file('product_image');
            $filePath  = public_path().'/uploads/images/products/';
            $productImage = md5(microtime()).'.'.$file->extension();
            $file->move($filePath, $productImage);
        }

    	// Insert Date
    	$product = new Product;
        $product->product_id = $id;
        $product->product_sku = $request->input('product_sku');
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_quantity = $request->input('product_quantity');
        $product->product_assigned_to = auth::user()->user_id;
    	$product->product_details = $request->input('product_details');
    	$product->product_image = $productImage;
    	$product->save();

    	session()->flash('save', 'Your data has been saved successfuly.');

    	if(!$request->ajax()){
    		return redirect()->back();
    	}
    }

    public function delete (Request $request)
    {
        $allProducts = $request->input('product_id');

        // Delete product image from directory
        foreach ($allProducts as $product) 
        {
            $productImage = Product::select('product_image')->where('product_id', '=', $product)->get();

            foreach ($productImage as $image) 
            {
                $productImagePath = public_path().'/uploads/images/products/'.$image->product_image;
                
                if (is_file($productImagePath)){
                    unlink($productImagePath);
                }
            }
        }

        // Delete product from database
        Product::destroy($allProducts);

        session()->flash('delete', 'Your data has been deleted successfuly.');

        if(!$request->ajax()){
            return redirect('products');
        }
    }

    public function updatePage ($id)
    {  
        $allProducts = Product::with('user')
                     ->where('product_id', '=', $id)
                     ->get();

        return view('products/update', compact('allProducts'));
    }

    public function update (Request $request)
    {
        $id = $request->input('product_id');

    	// Validation
    	$validatedData = $request->validate([
    		'product_name' => ['required', 'string', 'max:250'],
    		'product_price' => ['required', 'numeric'],
    		'product_quantity' => ['required', 'numeric'],
    		'product_details' => ['nullable', 'string'],
    		'product_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
    	]);

        // Get old image
        $productImage     = $request->input('product_old_image');
        $productImagePath = public_path().'/uploads/images/products/';

        if ($request->hasFile('product_image')) {
            // Delete old image if it exsits
            if (is_file($productImagePath.$productImage)) {
                unlink($productImagePath.$productImage);
            }

            // Upload new image
            $productNewImage = $request->file('product_image');
            $productImage = md5(microtime()).'.'.$productNewImage->extension();
            $productNewImage->move($productImagePath, $productImage);
        }

        // Update Date
        $product = Product::where('product_id', $id)->first();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_quantity = $request->input('product_quantity');
    	$product->product_details = $request->input('product_details');
    	$product->product_image = $productImage;
        $product->save();

        session()->flash('update', 'Your data has been updated successfuly.');

        if(!$request->ajax()){
            return redirect()->back();
        }
    }

    public function profile ($id)
    {
        $product  = Product::with('user')
                     ->where('product_id', '=', $id)
                     ->first();

        return view('products/profile', compact('product'));
    }
}
