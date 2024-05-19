<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $userAuth = Auth::user();
        $keyword = $request->keyword;
        $type_menu = 'categories';

        $categories = DB::table('categories')->where('id', '!=', $userAuth->id)->when($keyword, function (Builder $query, string $keyword) {
            $query->where('name', 'like', "%$keyword%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('pages.categories.index', compact('categories', 'keyword', 'type_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $type_menu = 'categories';
        return view('pages.categories.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }


        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Success create category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Success deleted category');
    }
}
