<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;
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
        // $request->validate(
        //     [
        //         'title' => 'required',
        //         'image' =>'required',
        //         'rating_star' =>'required',
        //         'description' =>'required'
        //     ]);


        //     $movie = movie::create([
        //         'title' => 
        //     ])
            
        //    return redirect()->route('movies.show',$movie->id);

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


    
    public function movie_cast_destroy($id){

        $cast = cast::find($id);
        $cast->delete();
        return redirect()->back();
    }

    public function movie_cast_store(Request $request, $movie_id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'cast_movie_name' => 'required',
        'cast_movie_role' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Membuat instance dari model Cast
    $cast = new Cast();
    $cast->name = $request->input('cast_movie_name');
    $cast->role = $request->input('cast_movie_role');
    $cast->movie_id = $movie_id;

    // Menyimpan data cast ke dalam database
    $cast->save();

    // Redirect kembali ke halaman detail movie
    return redirect()->route('movies.show', $movie_id)
        ->with('success', 'Cast berhasil ditambahkan.');
}



        
}


