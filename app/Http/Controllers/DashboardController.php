<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'dashboard';
        $users = User::where('role', '!=', 'admin')->get();
        $mapels = Mapel::all();
        $materis = Materi::all();
        return view('pages.dashboard.index', compact(
            'type_menu',
            'users',
            'mapels',
            'materis'
        ));
    }
}
