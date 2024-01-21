<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'studi';
        $materis = Materi::all();

        return view('pages.materi.index', compact('type_menu', 'materis'));
    }

    public function create()
    {
        $type_menu = 'studi';
        $mapels = Mapel::all();

        return view('pages.materi.create', compact('type_menu', 'mapels'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "mapel_id" => "required",
            "judul_materi" => "required|string",
            "semester" => "required|int",
            "pertemuan" => "required|int",
            "link_youtube" => "required|string",
            "file_materi" => "required|mimes:pdf|max:5120",
        ]);

        $file = $request->file('file_materi');
        $namaFile = $request->mapel_id . '-' . $request->judul_materi . '-' . $request->semester . '-' . $request->pertemuan . '.' . $file->getClientOriginalExtension();
        $file->move('materi/', $namaFile);

        Materi::create([
            "mapel_id" => $request->mapel_id,
            "materi" => $request->judul_materi,
            "semester" => $request->semester,
            "pertemuan" => $request->pertemuan,
            "link_youtube" => $request->link_youtube,
            "file_materi" => $namaFile,
        ]);

        return Redirect::route('materi.index')->with('success', 'Materi berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        $type_menu = 'studi';
        $mapels = Mapel::all();

        return view('pages.materi.edit', compact('type_menu', 'mapels', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        $file = $request->file('file_materi');

        $request->validate([
            "mapel_id" => "required",
            "judul_materi" => "required|string",
            "semester" => "required|int",
            "pertemuan" => "required|int",
            "link_youtube" => "required|string",
            "file_materi" => "mimes:pdf|max:5120",
        ]);

        $materi->update([
            "mapel_id" => $request->mapel_id,
            "materi" => $request->judul_materi,
            "semester" => $request->semester,
            "pertemuan" => $request->pertemuan,
            "link_youtube" => $request->link_youtube,
        ]);

        if ($file) {

            $file = $request->file('file_materi');
            $namaFile = $request->mapel_id . '-' . $request->judul_materi . '-' . $request->semester . '-' . $request->pertemuan . '.' . $file->getClientOriginalExtension();
            $file->move('materi/', $namaFile);

            $materi->update([
                "file_materi" => $namaFile,
            ]);
        }

        return Redirect::route('materi.index')->with('success', 'Materi berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return Redirect::route('materi.index')->with('success', 'Materi berhasil di hapus.');
    }
}
