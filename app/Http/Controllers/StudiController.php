<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;

class StudiController extends Controller
{
    public function detailMapel(Mapel $mapel)
    {
        $materis = Materi::where('mapel_id', $mapel->id)->groupBy('semester')->pluck('semester');

        return view('pages.detailmapel.index', compact('mapel', 'materis'));
    }

    public function detailMapelSemester(Mapel $mapel, string $semester)
    {
        $materis = Materi::where('mapel_id', $mapel->id)->where('semester', $semester)->orderBy('pertemuan', 'asc')->get();
        return view('pages.detailmapel.semester', compact('materis', 'mapel', 'semester'));
    }
}
