@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center items-center h-screen">
        <div class="w-full md:w-1/2 lg:w-1/3">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-blue-600">{{ __('Register') }}</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-input mt-1 block w-full @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-input mt-1 block w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-input mt-1 block w-full @error('password') border-red-500 @enderror" name="password" required>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="block text-gray-700">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-input mt-1 block w-full" name="password_confirmation" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
