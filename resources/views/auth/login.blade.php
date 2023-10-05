@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:items-center gap-6">
        <div class="md:w-6/12">
            <img src="{{asset('img/login.jpg')}}" alt="imagen_login">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-2xl">

            @if (session('mensaje'))
                <p class="bg-rose-600 p-2 text-white text-center mb-4 rounded">{{ session('mensaje') }}</p>
            @endif
            
            <form action="{{route('login')}}" method="POST" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="email" class="block mb-2 font-bold uppercase text-gray-500">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu email"
                        class="border p-2 rounded-lg w-full @error('email') border-rose-600 @enderror"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror                    
                </div>

                <div class="mb-4">
                    <label for="password" class="block mb-2 font-bold uppercase text-gray-500">password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu password"
                        class="border p-2 rounded-lg w-full @error('password') border-rose-600 @enderror"
                    >
                    @error('password')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror                    
                </div>

                <div class="mb-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-gray-500">Mantener sesión abierta</label>
                </div>

                <input
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-indigo-500 hover:bg-indigo-700 transition-colors p-2 rounded-lg w-full text-white uppercase font-bold cursor-pointer"
                >
            </form>
        </div>
    </div>
@endsection