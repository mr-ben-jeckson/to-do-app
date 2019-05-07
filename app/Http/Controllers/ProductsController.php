<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate('5');

        return ProductResource::collection($products);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $product = $request->isMethod('put') ? Product::findOrFail($request->product_id) : new Product;
        $product->id = $request->input('product_id');
        $product->title = $request->input('title');
        $product->content = $request->input('content');
        $product->status = $request->input('status');

        if ($product->save()){
            return new ProductResource($product);
        }
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }


    public function finish($id)
    {
        $product = Product::findOrFail($id);
        $product->status = '1';
        if ($product->save()){
            return new ProductResource($product);
        }
    }

    public function todo($id)
    {
        $product = Product::findOrFail($id);
        $product->status = '0';
        $product->update();

        return new ProductResource($product);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()){
            return new ProductResource($product);
        }
    }
}
