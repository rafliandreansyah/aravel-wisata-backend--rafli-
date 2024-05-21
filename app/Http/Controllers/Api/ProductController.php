<?php

namespace App\Http\Controllers\Api;

use App\Enum\ApiStatus;
use App\Enum\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //get list products
    public function index(Request $request)
    {
        $status = $request->status;

        if (!$status) {
            $status = ProductStatus::Publish;
        }

        $products = Product::with('category')->without('id')->where('status', $status)->orderBy('favorite', 'desc')->get();

        return response()->json([
            'status' => ApiStatus::Success,
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {

        // validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'criteria' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favorite' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => $validator->messages()->first()
            ], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->criteria = $request->criteria;
        $product->status = $request->status;
        $product->favorite = $request->favorite;


        $file = $request->file('image');

        if ($file && $file->getSize()) {
            $fileName = $product->id . round(Carbon::now()->valueOf());
            $file->storeAs('public/images/products',  $fileName . '.' . $file->extension());
            $product->image = 'images/products/' . $fileName . '.' . $file->extension();
        }

        $product->save();

        return response()->json([
            'status' => ApiStatus::Success,
            'message' => 'Success created product',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id)
    {


        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => 'Product not found'
            ], 404);
        }


        // validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'criteria' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favorite' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => $validator->messages()->first()
            ], 400);
        }


        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->criteria = $request->criteria;
        $product->status = $request->status;
        $product->favorite = $request->favorite;


        $file = $request->file('image');

        if ($file && $file->getSize()) {
            $fileName = $product->id . round(Carbon::now()->valueOf());
            $file->storeAs('public/images/products',  $fileName . '.' . $file->extension());
            $product->image = 'images/products/' . $fileName . '.' . $file->extension();
        }

        $product->save();

        return response()->json([
            'status' => ApiStatus::Success,
            'message' => 'Success edited product',
            'data' => $product
        ], 200);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'status' => ApiStatus::Success,
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => 'Product not found'
            ], 404);
        }
        $product->delete();

        return response()->json([
            'status' => ApiStatus::Success,
            'message' => 'Delete product successfully'
        ], 200);
    }
}
