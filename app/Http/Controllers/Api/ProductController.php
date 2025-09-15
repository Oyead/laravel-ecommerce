<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Using Validator facade for consistency

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return new ProductResource($product);
        }
        return response()->json(["message" => "Product not found"], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "desc" => 'required|string',
            "price" => 'required|numeric|min:0',
            "quantity" => 'required|integer|min:0',
            "image" => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['image'] = Storage::putFile("products", $request->image);
        $product = Product::create($data);

        return response()->json([
            "message" => "Product created successfully.",
            "product" => new ProductResource($product)
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // NEW: Moved findOrFail to the top to fail early if not found
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            "name" => 'sometimes|required|string|max:255',
            "desc" => 'sometimes|required|string',
            "price" => 'sometimes|required|numeric|min:0',
            "quantity" => 'sometimes|required|integer|min:0',
            "image" => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $data['image'] = Storage::putFile("products", $request->image);
        }

        $product->update($data);

        return response()->json([
            "message" => "Product updated successfully.",
            "product" => new ProductResource($product)
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();

        return response()->json(["message" => "Product deleted successfully."], 200);
    }
}