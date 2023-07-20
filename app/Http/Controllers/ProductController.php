<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('*')
            ->with('images:id,product_id,file_name')->get();


        // $products = Product::select('product.*', 'product_images.file_name')
        // ->join('product_images', 'product.id', '=', 'product_images.product_id')
        // ->get();

        return response()->json([
            'message' => 'All Products fetched successfully',
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
        // $product->fileList = $data['fileList'];
        $product->in_stock = $data['in_stock'] == 'yes' ? true : false;
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->deleted_at = null;
        $product->save();

        $product_image = new ProductImage();
        $product_image->product_id = $product->id;
        $product_image->file_name = $data['fileList'];
        $product_image->save();

        return response()->json([
            'message' => 'Product added successfully',
            'status' => 'ok',
            'data' => $product_image,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::where('id', $id)->first();
        $product = Product::select('*')
            ->with('images:id,product_id,file_name')->where('id', $id)->first();
        // $product = Product::join('product_images', 'product.id', '=', 'product_images.product_id')
        //     ->get(['product.*', 'product_images.file_name'])->where('id', $id)->first();
        return response()->json([
            'message' => 'Product fetched successfully',
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
        // $product->fileList = $data['fileList'];
        $product->in_stock = $data['in_stock'] == 'yes' ? true : false;
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->deleted_at = null;
        $product->save();

        $product_image = ProductImage::where('product_id', $id)->first();
        $product_image->product_id = $product->id;
        $product_image->file_name = $data['fileList'];
        $product_image->save();

        return response()->json([
            'status' => 'ok',
            'data' => $product,
            'message' => 'User Updated Successfully'
        ]);
    }
}