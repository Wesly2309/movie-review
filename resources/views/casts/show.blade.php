@extends('layouts.app')

@section('content')
    <div class="card">
        <img class="card-image-top" src="{{ $cast->image }}">
        <div class="card-body">
            <h1>{{ $cast->name }}</h1>
            <p>All Movies of {{ $cast->name }}</p>
            <ul class="list-group list-group-flush">
                @if (count($movies))
                    @foreach ($movies as $movie)
                        <li class="list-group-item">
                            <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
                        </li>
                    @endforeach
                @endif

            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('casts.destroy', $cast->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link float-end">Delete</button>

            </form>
        </div>
    </div>
@endsection