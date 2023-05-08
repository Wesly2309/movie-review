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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cast_name' => 'required',
            'cast_image' => 'required'
        ]);

        Cast::create([
            'name' => $request->cast_name,
            'image' => $request->cast_image,
            'role' =>$request->cast_movie_role
        ]);
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show( Movie $movie , Cast $cast )
    {
        $movies = movie::all()->where('id');
        return view('casts.show', compact('movies' , 'cast'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cast $cast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cast $cast)
    {
        $cast->delete();
        return redirect()->route('movies.index');
    }
}