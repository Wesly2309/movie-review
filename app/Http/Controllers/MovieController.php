<?php

// app/Http/Controllers/MovieController.php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rating_star' => 'required|integer|min=1|max=10',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $movie = Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'rating_star' => $request->rating_star,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Movie created successfully.');
    }

    public function show($id)
    {
    // Fetch the movie along with its related casts
    $movie = Movie::with('casts')->findOrFail($id);

    // Pass the movie with casts to the view
    return view('movies.show', [
        'movie' => $movie,
        'casts' => $movie->casts  // Ensure casts is available for the view
    ]);
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rating_star' => 'required|integer|min=1|max=10',
            'image' => 'nullable|image|max=2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $movie->update([
                'image' => $imagePath,
            ]);
        }

        $movie->update($request->only(['title', 'description', 'rating_star']));

        return redirect()->route('movies.show', $movie->id)->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
