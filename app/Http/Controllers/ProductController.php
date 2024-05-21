<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $type_menu = 'products';

        $products = Product::when($keyword, function (Builder $query, String $keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('criteria', 'like', "%$keyword%")
                ->orWhere('price', 'like', "%$keyword%");
        })->orderBy('favorite', 'desc')->paginate(10);

        return view('pages.products.index', compact('type_menu', 'products', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        $type_menu = 'products';
        $categories = Category::all();
        return view('pages.products.create', compact('product', 'type_menu', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|max:255',
                'criteria' => 'required',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favorite' => 'required',
                'stock' => 'required',
                'status' => 'required',
            ]);
        } catch (ValidationException $e) {
            dd($e);
            return back()->withErrors($e->validator->errors())->withInput();
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

        return redirect()->route('products.index')->with('success', 'Success create a new product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $type_menu = 'products';
        $categories = Category::all();
        return view('pages.products.edit', compact('product', 'type_menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'criteria' => 'required',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favorite' => 'required',
                'stock' => 'required',
                'status' => 'required',
            ]);
        } catch (ValidationException $e) {
            dd($e);
            return back()->withErrors($e->validator->errors())->withInput();
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

        return redirect()->route('products.index')->with('success', 'Success create a new product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Success deleted product');
    }
}
