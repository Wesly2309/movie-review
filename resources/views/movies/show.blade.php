@extends('layouts.app')

@section('content')
    <div class="card my-5">
        <img src="{{ $movie->image }}" width="200" alt="" class="card-image-top">
        <div class="card-body">
            <h1>{{ $movie->title }}</h1>
            <div class="text-danger">
                @for ($i = 1; $i <= $movie->rating_star; $i++)
                    <i class="fas fa-star"></i>
                @endfor
            </div>
            <p>{{ $movie->description }}</p>

            <h3>Cast
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                </button>
            </h3>
            <ul class="list-group list-group-flush">
                @foreach ($casts as $cast)
                    <li class="list-group-item">{{ $cast->name }} -
                        <span class="text-muted ">{{ $cast->role }}</span>
                        <form action="#" method="post">
                            <button type="submit" class="btn btn-link text-danger text-decoration-none">Delete</button>
                        </form>
                    </li>
                @endforeach

            </ul>


            <h3>Comments</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Tes:</b> This Movie so scary
                    <form action="#" method="post">
                        <button type="submit" class="btn btn-link text-danger text-decoration-none">Delete</button>
                    </form>
                </li>
            </ul>
            <form action="{{ route('movies.comments.store', $movie->id) }}" method="post">
                <input type="text" class="form-control" placeholder="berikan komentar anda">
                <button type="submit" class="btn btn-primary mt-2 float-end">Comment</button>
            </form>
        </div>
        <div class="card-footer">
            <form action="#">
                <button type="submit" class="btn btn-link float-end">Delete</button>
            </form>
        </div>
    </div>

    {{-- Modal --}}
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Cast</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Cast Role</h1>
                            <form action="{{ route('movie_cast_store', $movie->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Actor Name</label>
                                    <select name="cast_movie_name" class="form-control">
                                        <option value="#" disabled selected>Choose Cast</option>
                                        @if (count($casts))
                                            @foreach ($casts as $cast)
                                                <option value="{{ $cast->id }}">{{ $cast->name }}</option>
                                            @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" name="cast_movie_role">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2 float-end">Submit</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h1>New Cast</h1>
                            <form action="{{ route('movie_cast_store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Actor Name</label>
                                    <input type="text" class="form-control" name="cast_name">
                                </div>
                                <div class="form-group">
                                    <label>Actor Image</label>
                                    <input type="text" class="form-control" name="cast_image">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" name="cast_role">
                                </div>
                                <button type="submit" class="btn btn-primary float-end mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
