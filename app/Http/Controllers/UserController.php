<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //index
    public function index(Request $request): View
    {
        $userAuth = Auth::user();
        $keyword = $request->keyword;

        $users = DB::table('users')->where('id', '!=', $userAuth->id)->when($keyword, function (Builder $query, string $keyword) {

            $query->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->orWhere('phone', 'like', "%$keyword%")
                ->orWhere('role', 'like', "%$keyword%");
        })->orderBy('id', 'desc')->paginate(10);

        $type_menu = 'users';


        // return view('pages.users.index', [
        //     'users' => $users,
        //     'type_menu' => $type_menu,
        // ]);

        // atau lebih simple menggunakan compact
        return view('pages.users.index', compact('users', 'type_menu', 'keyword'));
    }

    //get view create user
    public function create(): View
    {
        return view('pages.users.create', [
            'type_menu' => 'users',
        ]);
    }

    //post create user
    public function store(Request $request)
    {
        //dd($request);
        try {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'phone' => 'nullable|numeric|unique:users',
                'password' => 'required|confirmed|min:8',
                'role' => 'required'
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }


        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'Success create user');
    }

    //edit
    public function edit(): View
    {
        return view('pages.users.edit', [
            'type_menu' => 'users',
        ]);
    }
}
