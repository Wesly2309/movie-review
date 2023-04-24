@extends('layouts.app')


@section('content')
    <div class="card my-5">
        <div class="card-body">
            <h1>Add New Movie</h1>
            <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label>Rating Stars</label>
                    <input type="text" class="form-control" name="rating_star">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
@endsection
