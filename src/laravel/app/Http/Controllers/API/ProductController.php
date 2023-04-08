<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $producr = Product::all();
        return new ProductResource($producr);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $imagePath = $request->image->storeAs('public/images', $imageName);

        $product = new Product();
        $product->image = str_replace('public/', 'storage/', $imagePath);

        $product->fill($request->all())->save();


        return response()->json([
            'product' => $product,
            'success' => '画像がアップロードされました。',
            'image_path' => $product->image,
        ]);
    }

    public function show($id)
    {
        $producr = Product::find($id);
        return new ProductResource($producr);
    }

    public function edit(Request $id)
    {
        $producr = Product::find($id);
        return new ProductResource($producr);
    }
}
