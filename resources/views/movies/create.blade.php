@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-center">
        <div class="w-full md:w-4/5 lg:w-2/3 xl:w-1/2">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-800 text-white p-6 text-center">
                    <h2 class="text-3xl font-bold">{{ __('Add New Movie') }}</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block text-gray-800 text-lg font-medium mb-2">Title</label>
                            <input id="title" type="text" class="form-input mt-1 block w-full border-custom-gray rounded-md shadow-sm @error('title') border-custom-error @else border-custom-default @enderror" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="image" class="block text-gray-800 text-lg font-medium mb-2">Image</label>
                            <input id="image" type="file" class="form-input mt-1 block w-full border-custom-gray rounded-md shadow-sm @error('image') border-custom-error @else border-custom-default @enderror" name="image" required>
                            @error('image')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="rating_star" class="block text-gray-800 text-lg font-medium mb-2">Rating Stars</label>
                            <input id="rating_star" type="number" class="form-input mt-1 block w-full border-custom-gray rounded-md shadow-sm @error('rating_star') border-custom-error @else border-custom-default @enderror" name="rating_star" min="1" max="5" required>
                            @error('rating_star')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="description" class="block text-gray-800 text-lg font-medium mb-2">Description</label>
                            <textarea id="description" class="form-textarea mt-1 block w-full border-custom-gray rounded-md shadow-sm @error('description') border-custom-error @else border-custom-default @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-800 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 transition duration-150 ease-in-out">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
