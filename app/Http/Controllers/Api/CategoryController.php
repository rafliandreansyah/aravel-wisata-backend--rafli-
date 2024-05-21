<?php

namespace App\Http\Controllers\Api;

use App\Enum\ApiStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // get list categories
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => ApiStatus::Success,
            'categories' => $categories
        ], 200);
    }
}
