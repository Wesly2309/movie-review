@extends('layouts.app')

@section('content')
    <div class="card my-5">
        <img src="/movieimage/{{ $movie->image }}" width="200" alt="" class="card-image-top">
        <div class="card-body">
            <h1>{{ $movie->title }}</h1>
            <div class="text-danger">
                @for ($i = 1; $i <= $movie->rating_star; $i++)
                    <i class="fas fa-star"></i>
                @endfor
            </div>
            <p>{{ $movie->description }}</p>


            <h3>Cast
                @auth
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-plus"></i>
                    </button>
                @endauth
            </h3>
            <ul class="list-group list-group-flush">
                @if (count($casts))
                    @foreach ($casts as $cast)
                        <li class="list-group-item">
                            <a href="{{ route('casts.show', $cast->id) }}">{{ $cast->name }}</a> -
                            <span class="text-muted font-italic">{{ $cast->role }}</span>
                            @auth
                                <form action="{{ route('movie_cast_destroy', [$movie->id, $cast->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link text-danger">Delete</button>
                                </form>
                            @endauth
                        </li>
                    @endforeach
                @else
                    No Casts!
                @endif

            </ul>


            <h3>Comments</h3>
            <ul class="list-group list-group-flush">
                @if (count($movie->comments))
                    @foreach ($movie->comments as $comment)
                        <li class="list-group-item"><b>{{ $comment->user->name }}: </b>{{ $comment->content }}
                            @auth
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link text-danger">Delete</button>
                                </form>
                            @endauth
                        </li>
                    @endforeach
                @else
                    No Comments!
                @endif
            </ul>
            <form action="{{ route('movies.comments.store', $movie->id) }}" method="post">
                @csrf
                <input type="text" name="comment" class="form-control" placeholder="Berikan Komentar Anda">
                <button type="submit" class="btn btn-primary mt-2 float-end">Comment</button>
            </form>

        </div>
        @auth
            <div class="card-footer">
                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-link float-end">Delete</button>
                </form>
            </div>
        @endauth
    </div>

    @auth


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">New Cast</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Cast Role</h1>
                                <form action="{{ route('cast.update'), $cast->id }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Actor Name</label>
                                        <select name="cast_movie_name" class="form-control">
                                            <option value="" disabled selected>Choose Cast</option>
                                            @if (count($casts))
                                                @foreach ($casts as $cast)
                                                    <option value="{{ $cast->id }}">{{ $cast->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Old Actor Role</label>
                                        <input type="text" value="{{ $cast->role }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>New Actor Role</label>
                                        <input type="text" name="cast_role" class="form-control">
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary mt-2 float-end">Update</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h1>New Cast</h1>
                                <form action="{{ route('casts.store') }}" method="post" enctype="multipart/form-data">
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
                                        <label>Actor Role</label>
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
    @endauth
@endsection
