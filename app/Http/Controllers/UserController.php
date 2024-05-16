<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    //index
    public function index(): View
    {
        return view('pages.users.index', [
            'type_menu' => 'users',
        ]);
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
