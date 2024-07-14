@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full md:w-2/3 lg:w-1/2">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img class="w-full h-auto object-cover" src="{{ $cast->image }}" alt="{{ $cast->name }}">
            <div class="p-4">
                <h1 class="text-xl font-bold">{{ $cast->name }}</h1>
                <p class="mt-2">All Movies of {{ $cast->name }}</p>
                <ul class="list-group list-group-flush">
                    @if ($movies->count())
                        @foreach ($movies as $movie)
                            <li class="list-group-item">
                                <a href="{{ route('movies.show', $movie->id) }}" class="font-bold text-blue-800">{{ $movie->title }}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item">No Movies</li>
                    @endif
                </ul>
            </div>
            <div class="bg-gray-100 p-4">
                @auth
                    <form action="{{ route('casts.destroy', $cast->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-link float-end">Delete</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
