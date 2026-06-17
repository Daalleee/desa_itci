@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-green-800">DESA ITCI</h1>
            <p class="text-sm text-gray-500 mt-1">Sistem Informasi Penduduk Desa ITCI</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                Masuk
            </button>
        </form>
    </div>
@endsection
