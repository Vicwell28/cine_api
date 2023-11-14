<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    public function index()
    {
        return Director::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'director' => 'required|string|max:255',
        ]);

        $director = Director::create($validatedData);

        return response()->json($director, 201);
    }

    public function show($id)
    {
        return Director::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $director = Director::findOrFail($id);

        $validatedData = $request->validate([
            'director' => 'string|max:255',
        ]);

        $director->update($validatedData);

        return response()->json($director, 200);
    }

    public function destroy($id)
    {
        $director = Director::findOrFail($id);
        $director->delete();

        return response()->json(null, 204);
    }
}