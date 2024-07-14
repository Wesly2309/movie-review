@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-1/3">
            {{-- Card --}}
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                {{-- <img class="w-full h-48 object-cover" src="{{ $movie->image }}" --}}
                <div class="p-4">
                    {{-- Card content here --}}
                </div>
            </div>
        </div>
    </div>
@endsection
