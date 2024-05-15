<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marker;
use Illuminate\Http\Response; 

class HomeController extends Controller
{
    public function index()
    {
        $markers = Marker::all();
        return response()->json($markers); // Menggunakan response()->json()
    }

    public function show($id)
    {
        $marker = Marker::findOrFail($id);
        return response()->json($marker); // Menggunakan response()->json()
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'Keterangan' => 'required',
            'kategori' => 'required',
        ]);

        $marker = Marker::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'Keterangan' => $request->Keterangan,
            'kategori' => $request->kategori,
        ]);

        return response()->json($marker); // Menggunakan response()->json()
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'Keterangan' => 'required',
            'kategori' => 'required',
        ]);

        $marker = Marker::findOrFail($id);
        $marker->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'Keterangan' => $request->Keterangan,
            'kategori' => $request->kategori,
        ]);

        return response()->json($marker); // Menggunakan response()->json()
    }

    public function destroy($id)
    {
        $marker = Marker::findOrFail($id);
        $marker->delete();

        return response()->json(['message' => 'Marker deleted successfully']); // Menggunakan response()->json()
    }

    public function search(Request $request)
    {
        $request->validate([
            'Keterangan' => 'required',
        ]);

        $Keterangan = $request->input('Keterangan');
        $markers = Marker::where('Keterangan', 'like', "%$Keterangan%")->get();

        return response()->json($markers); // Menggunakan response()->json()
    }
}
