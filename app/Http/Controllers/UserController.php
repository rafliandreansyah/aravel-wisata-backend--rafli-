<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //index
    public function index(): View
    {
        $userAuth = Auth::user();
        $users = DB::table('users')->where('id', '!=', $userAuth->id)->orderBy('id', 'desc')->paginate(10);

        $type_menu = 'users';


        // return view('pages.users.index', [
        //     'users' => $users,
        //     'type_menu' => $type_menu,
        // ]);

        // atau lebih simple menggunakan compact
        return view('pages.users.index', compact('users', 'type_menu'));
    }

    //create
    public function create(): View
    {
        return view('pages.users.create', [
            'type_menu' => 'users',
        ]);
    }

    //edit
    public function edit(): View
    {
        return view('pages.users.edit', [
            'type_menu' => 'users',
        ]);
    }
}
