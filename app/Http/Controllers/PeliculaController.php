<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Director;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class PeliculaController extends Controller
{
    public function index()
    {
        return Pelicula::with(['director', 'categoria'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'id_director' => 'required|exists:directores,id',
            'duracion' => 'required|string',
            'id_categoria' => 'required|exists:categorias,id',
            'sinopsis' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes_peliculas');
            $validatedData['imagen'] = $imagenPath;
        }

        $pelicula = Pelicula::create($validatedData);

        return response()->json($pelicula, 201);
    }

    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::findOrFail($id);

        $validatedData = $request->validate([
            'titulo' => 'string|max:255',
            'id_director' => 'exists:directores,id',
            'duracion' => 'string',
            'id_categoria' => 'exists:categorias,id',
            'sinopsis' => 'string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior antes de subir la nueva
            Storage::delete($pelicula->imagen);

            $imagenPath = $request->file('imagen')->store('imagenes_peliculas');
            $validatedData['imagen'] = $imagenPath;
        }

        $pelicula->update($validatedData);

        return response()->json($pelicula, 200);
    }

    public function destroy($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();

        return response()->json(null, 204);
    }
}