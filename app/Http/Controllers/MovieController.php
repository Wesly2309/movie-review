<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                'description' =>'required',
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
        $movie->detach();
        return back();
    }


    public function movie_cast_store(Request $request , Movie $movie) {
        $cast_name = $request->input('cast_name');
        $cast_image = $request->input('cast_image');
        $cast_role = $request->input('cast_role');
        $cast = new Cast(['name' => $cast_name, 'image' => $cast_image, 'role' => $cast_role]);
        $movie->casts()->save($cast);
        return redirect()->back()->with('success', 'Cast has been added successfully');

    }
    public function movie_cast_destroy(Movie $movie , Cast $cast){
        $movie->cast()->detach($cast->id);
        return back();
    }


        


        
    }


