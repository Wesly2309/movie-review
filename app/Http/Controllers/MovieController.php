<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
    }

    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'image' =>'required',
                'rating_star' =>'required',
                'description' =>'required'
            ]);

           $movie = Movie::create($request->all());
           
           return redirect()->route('movies.show',$movie->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $casts = Cast::all();
        return view('movies.show', compact('movie', 'casts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }


    public function movie_cast_store(Request $request , Movie $movie) {
        $request->validate([
            'cast_movie_name' => 'required',
            'cast_movie_role' => 'required'
        ]);
        $movie->casts()->attach($request->cast_movie_name, ['role' => $request->cast_movie_role]);
        return back();
    }
    public function movie_cast_destroy(Movie $movie , Cast $cast){
        
        
        $movie->casts()->detach($cast->id);
        return back();
    }


        


        
}


