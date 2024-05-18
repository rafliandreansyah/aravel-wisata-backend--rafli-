<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

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

    //get edit user form
    public function edit(User $user): View
    {
        $type_menu = 'users';
        return view('pages.users.edit', compact('type_menu', 'user'));
    }

    //put/patch for edit user
    public function update(Request $request, User $user)
    {
        try {

            if (!$request->filled('password')) {
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email',
                    'phone' => 'nullable|numeric',
                    'role' => 'required'
                ]);
            } else {
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email',
                    'phone' => 'nullable|numeric',
                    'password' => 'required|confirmed|min:8',
                    'role' => 'required'
                ]);
                $user->password = Hash::make($request->password);
            }

            if ($user->phone) {
                $user->phone = $request->phone;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;

            $user->save();
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }

        return redirect()->route('users.index')->with('success', 'Edit user success');
    }

    // delete user by id
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Delete user success');
    }
}
