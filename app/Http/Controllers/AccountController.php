<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function index()
    {
        $type_menu = "account";
        return view('pages.account.index', compact('type_menu'));
    }

    public function update(Request $request, User $account)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $account->update([
            'name' => $request->name
        ]);

        return Redirect::route('account.index')->with('success', 'Profile berhasil di ubah.');
    }
}
