@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full md:w-1/3">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="full-screen-image">
            <div class="p-4">
                <h1 class="text-3xl font-bold text-blue-800">{{ $movie->title }}</h1>
                <div class="text-yellow-500 my-2">
                    @for ($i = 1; $i <= $movie->rating_star; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="text-gray-700">{{ $movie->description }}</p>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-blue-800 flex items-center">Cast
                        @auth
                            <button type="button" class="ml-3 inline-block px-3 py-1 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700" onclick="toggleCastForm()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endauth
                    </h3>
                    <ul class="list-group list-group-flush mt-3">
                        @forelse ($casts as $cast)
                            <li class="list-group-item flex justify-between items-center py-2">
                                <div>
                                    <a href="{{ route('casts.show', $cast->id) }}" class="text-blue-600 hover:underline">{{ $cast->name }}</a> -
                                    <span class="text-gray-600 italic">{{ $cast->pivot->role }}</span>
                                </div>
                                @auth
                                    <form action="{{ route('movie_cast_destroy', [$movie->id, $cast->id]) }}" method="post" class="inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                @endauth
                            </li>
                        @empty
                            <li class="list-group-item">No Casts!</li>
                        @endforelse
                    </ul>

                    <!-- Cast Form -->
                    <div id="castForm" class="mt-6 hidden">
                        <h3 class="text-lg font-semibold text-blue-800">New Cast</h3>
                        <form action="{{ route('casts.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}"> <!-- Pass the movie ID -->
                            <div class="form-group mb-3">
                                <label class="block text-sm font-medium text-gray-700">Actor Name</label>
                                <input type="text" class="form-control border-gray-300 rounded-md w-full p-2" name="cast_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="block text-sm font-medium text-gray-700">Actor Image</label>
                                <input type="text" class="form-control border-gray-300 rounded-md w-full p-2" name="cast_image" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="block text-sm font-medium text-gray-700">Actor Role</label>
                                <input type="text" class="form-control border-gray-300 rounded-md w-full p-2" name="cast_movie_role" required>
                            </div>
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-blue-800">Comments</h3>
                    <ul class="list-group list-group-flush mt-3">
                        @if ($movie->comments->count())
                            @foreach ($movie->comments as $comment)
                                <li class="list-group-item flex justify-between items-center py-2">
                                    <div><b>{{ $comment->user->name }}: </b>{{ $comment->content }}</div>
                                    @auth
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post" class="inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    @endauth
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No Comments!</li>
                        @endif
                    </ul>
                    <form action="{{ route('movies.comments.store', $movie->id) }}" method="post" class="mt-3">
                        @csrf
                        <input type="text" name="comment" class="form-control border-gray-300 rounded-md w-full p-2" placeholder="Berikan Komentar Anda">
                        <button type="submit" class="mt-2 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Comment</button>
                    </form>
                </div>
            </div>

            @auth
                <div class="p-6 bg-gray-100 border-t border-gray-200">
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>

<script>
    function toggleCastForm() {
        var form = document.getElementById('castForm');
        form.classList.toggle('hidden');
    }
</script>

@endsection
