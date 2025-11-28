<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        if($products){
        // resource  // collection
        return ProductResource::collection($products);
        }else{
            return response()->json([
                'msg' => "No Data Founded"
            ],404);
        }


    }

    public function show($id){
        $product = Product::find($id);
        if($product){
        // resource  // collection
        return new ProductResource($product);
        }else{
            return response()->json([
                'msg' => "No Data Founded"
            ],404);
        }

    }

    public function store(Request $request){
        //valid
        $errors = Validator::make($request->all(),[
            "name" => 'required|string|max:255',
            "desc" => 'required',
            "price" => 'required|numeric',
            "quantity" => 'required|numeric',
            "image" => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if($errors->fails()){
            return response()->json([
                'error' => $errors->errors() // errors   -> class validator
            ],301);
        }

        //image
        $image = Storage::putFile("products",$request->image);


        // create
        // $product = Product::create($data);
        $product = Product::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "image" => $image,

        ]);
        //redirect
            return response()->json([
                'msg' => "Product Created Successfuly"
            ],200);
    }

    public function update(Request $request , $id){
        // select one
        // dd($request);
        $product = Product::find($id);
        if($product == null){
          return response()->json([
                'msg' => "No Data Founded"
            ],404);
        }
        //valid

        $errors = Validator::make($request->all(),[
            "name" => 'required|string|max:255',
            "desc" => 'required',
            "price" => 'required|numeric',
            "quantity" => 'required|numeric',
            "image" => 'image|mimes:png,jpg,jpeg',
        ]);

        if($errors->fails()){
            return response()->json([
                'error' => $errors->errors() // errors   -> class validator
            ],301);
        }


        //image
        //remove
        if($request->hasFile("image")){
            Storage::delete($product->image);
            $image = Storage::putFile("products",$request->image);
        }else{
            $image = $product->image;
        }

        // update
        // $product = Product::create($data);
        $product->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "image" => $image,

        ]);

        //redirect
            return response()->json([
                'msg' => "Product updated Successfuly",
                "product" => new ProductResource($product),
            ],200);
    }

        public function destroy(Request $request , $id){
        $product = Product::find($id);
        if($product == null){
          return response()->json([
                'msg' => "No Data Founded"
            ],404);
        }
        if($product->image != null){
         Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            'msg' => "Product deleted Successfuly",
        ],200);
    }
}
