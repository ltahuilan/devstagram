@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
<div class="md:flex gap-8 md:justify-center">
    <div class="md:w-1/2 lg:w-6/12">
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen registro">
    </div>

    <div class="md:w-1/2 lg:w-4/12 bg-white p-4 rounded-lg shadow-lg">

        <form method="POST" action="{{route('login')}}" novalidate>
            @csrf

            @if (session('mensaje'))
                <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{session('mensaje')}}</p>
            @endif

            <div class="mb-5">
                <label for="email" class="mb-2 block text-gray-500 uppercase font-bold">
                    Email:
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Tu email"
                    class="w-full p-2 rounded-lg border @error('name'){{'border-rose-500'}}@enderror"
                    value="{{ old('email') }}"
                >
                @error('email')    
                    <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>                    
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block text-gray-500 uppercase font-bold">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Tu password"
                    class="w-full p-2 rounded-lg border @error('email') {{'border-rose-500'}} @enderror"
                >
                @error('password')
                    <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5 flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" class="text-gray-500">Mantener sesión abierta</label>
            </div>

            <input
                type="submit"
                value="Inicia Sesión"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg uppercase font-bold cursor-pointer"
            >
        </form>
    </div>
@endsection