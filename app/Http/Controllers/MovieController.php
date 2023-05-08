<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
       $data = new movie;

        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();

        $request->image->move('movieimage', $imagename);

        $data->image= $imagename;

        $data->title = $request->title;
        $data->rating_star = $request->rating_star;
        $data->description= $request->description;

        $data->save();

        return redirect()->route('movies.show',$data->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie , Cast $cast)
    {
        $casts = cast::whereNotNull('name')->get();
        
        return view('movies.show', compact('movie','casts'));
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

public function movie_cast_destroy(Movie $movie , $id)
{

    $cast = Cast::find($id);
    $cast->delete();
    return redirect()->back();
    
}


        
}