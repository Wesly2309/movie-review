<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cast_name' => 'required|string|max:255',
            'cast_image' => 'required|url',
            'cast_movie_role' => 'required|string|max:255',
        ]);

        // Find the movie
        $movie = Movie::find($validated['movie_id']);

        // Create or update the cast and attach to movie
        $cast = new Cast();
        $cast->name = $validated['cast_name'];
        $cast->image = $validated['cast_image'];
        $cast->role = $validated['cast_movie_role'];
        $cast->save();

        // Attach cast to movie
        $movie->casts()->attach($cast->id, ['role' => $cast->role]);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Cast added successfully.');
    }

    public function show(Cast $cast)
    {
        $movies = $cast->movies;

        return view('casts.show', compact('cast', 'movies'));
    }

    public function edit(Cast $cast)
    {
    }

    public function update(Request $request, Cast $cast)
    {
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();

        return redirect()->route('movies.index');
    }
}
