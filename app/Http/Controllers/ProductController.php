<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'message'=>'All Products fetched successfully',
            'status' => 'ok',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->fileList = $data['fileList'];
        $product->in_stock = $data['in_stock'] == 'yes' ? true : false;
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->deleted_at = null;
        $product->save();
        return response()->json([
            'message'=>'Product added successfully',
            'status' => 'ok',
            'data'=>$product
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json([
            'message'=>'Product fetched successfully',
            'status' => 'ok',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $product = Product::where('id', $id)->first();
        $product->name = $data['name'];
        $product->fileList = $data['fileList'];
        $product->in_stock = $data['in_stock'] == 'yes' ? true : false;
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->deleted_at = null;
        $product->save();
        return response()->json([
            'status' => 'ok',
            'data' => $product,
            'message' => 'User Updated Successfully'
        ]);
    }
}