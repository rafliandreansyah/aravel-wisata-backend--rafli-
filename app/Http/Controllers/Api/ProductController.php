<?php

namespace App\Http\Controllers\Api;

use App\Enum\ApiStatus;
use App\Enum\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

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
