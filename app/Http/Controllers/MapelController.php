<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Database\Seeders\generateCodeMapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'studi';
        $mapels = Mapel::latest()->get();

        return view('pages.mapel.index', compact('type_menu', 'mapels'));
    }

    public function create()
    {
        $type_menu = 'studi';

        return view('pages.mapel.create', compact('type_menu'));
    }

    private function generateCodeMapel($name)
    {
        $length = strlen($name);

        if ($length < 3) {
            $code = strtoupper($name);
        } else {
            $code = strtoupper(substr($name, 0, 1) . substr($name, floor($length / 2), 1) . substr($name, -1));
        }

        return $code;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Mapel::create([
            'name' => $request->name,
            'code' => $this->generateCodeMapel($request->name) . '-' . time()
        ]);

        return Redirect::route('mapel.index')->with('success', 'Mata Pelajaran berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        $type_menu = 'studi';

        return view('pages.mapel.edit', compact('type_menu', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'name' => 'required|string|unique:mapels,name,' . $mapel->id,
        ]);

        $mapel->update([
            'name' => $request->name,
            'code' =>  $this->generateCodeMapel($request->name) . '-' . time()
        ]);

        return Redirect::route('mapel.index')->with('success', 'Mata Pelajaran berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return Redirect::route('mapel.index')->with('success', 'Mata Pelajaran berhasil di hapus.');
    }
}
