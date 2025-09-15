<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //

    //index
    public function index(){
        $products = Product::all();
        return view('admin.products.index')->with('products' ,$products);
    }

    // create

    public function create(){
        return view('admin.products.create');
    }

    //store

public function store(Request $request){
    //valid
    $data = $request->validate([
        "name" => 'required|string|max:255',
        "desc" => 'required',
        "price" => 'required|numeric',
        "quantity" => 'required|numeric',
        "image" => 'required|image|mimes:png,jpg,jpeg',

    ]);


    //image
    $data['image'] = Storage::putFile("products",$request->image);


    // create
    $product = Product::create($data);
    //redirect
    return redirect()->route('products.index')->with('success','تم انشاء منتج بنجاح ');
}
    //edit

    //update

    //delete
    public function destroy(Request $request , $id){
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
    return redirect()->route('products.index')->with('success','تم مسح المنتج بنجاح ');

    }
    // Edit
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.products.edit', compact('product'));
}

// Update
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $data = $request->validate([
        "name" => 'required|string|max:255',
        "desc" => 'required',
        "price" => 'required|numeric',
        "quantity" => 'required|numeric',
        "image" => 'nullable|image|mimes:png,jpg,jpeg',
    ]);

    // if new image uploaded
    if ($request->hasFile('image')) {
        Storage::delete($product->image);
        $data['image'] = Storage::putFile("products", $request->image);
    } else {
        $data['image'] = $product->image; // keep old image
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
}

}
