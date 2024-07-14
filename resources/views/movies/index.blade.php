@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-blue-900">All Movies</h1>
            @auth
                <a href="{{ route('movies.create') }}" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-lg px-6 py-3 shadow-md transition-transform transform hover:scale-105">
                    <i class="fas fa-plus text-xl mr-3"></i> Add Movie
                </a>
            @endauth
        </div>

        <!-- No Movies Message -->
        @unless (count($movies))
            <p class="text-lg text-gray-600 text-center">No Movies Available</p>
        @endunless

        <!-- Movie Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @if (count($movies))
                @foreach ($movies as $movie)
                    <div class="bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="w-full-screen-image">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('movies.show', $movie->id) }}" class="text-blue-800 hover:text-blue-600">{{ $movie->title }}</a>
                            </h3>
                            <div class="text-yellow-500 mb-2">
                                @for ($i = 1; $i <= $movie->rating_star; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p class="text-gray-700">{{ Str::limit($movie->description, 120) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
