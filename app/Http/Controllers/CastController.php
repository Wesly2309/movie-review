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
        $cast = new cast;

        $cast->name = $request->cast_name;
        $cast->image = $request->cast_image;
        $cast->role = $request->cast_role;

        $cast->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Cast $cast)
    {

        $movies = movie::all();
        return view('casts.show', compact('cast','movies'));
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
    public function update(Request $request, $id)
    {
        $data = cast::find($id);


        $data->role = $request->cast_role;
        

        $data->save();
        return redirect()->back();
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
