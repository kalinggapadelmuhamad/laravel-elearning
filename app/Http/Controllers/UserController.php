<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'users';
        $users = User::latest()->get();
        return view('pages.user.index', compact('type_menu', 'users'));
    }

    public function create()
    {
        $type_menu = 'users';
        return view('pages.user.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            'password' => 'required|min:8',
            // 'password_confirmation' => 'required|confirmed',
            "roles" => "required|string"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->roles
        ]);

        return Redirect::route('users.index')->with('success', 'User berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $type_menu = 'users';
        return view('pages.user.edit', compact('type_menu', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'roles' => 'required|string'
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->roles
        ]);

        return Redirect::route('users.index')->with('success', 'User berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index')->with('success', 'User berhasil di hapus.');
    }
}
