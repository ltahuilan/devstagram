@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:items-center gap-6">
        <div class="md:w-6/12">
            <img src="{{asset('img/registrar.jpg')}}" alt="imagen_register">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-2xl">
            
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 font-bold uppercase text-gray-500">Nombre</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Tu nombre"
                        class="border p-2 rounded-lg w-full @error('name') border-rose-600 @enderror"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="block mb-2 font-bold uppercase text-gray-500">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu username"
                        class="border p-2 rounded-lg w-full @error('username') border-rose-600 @enderror"
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

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
                    <label for="password_confirmation" class="block mb-2 font-bold uppercase text-gray-500">Repetir password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite tu password"
                        class="border p-2 rounded-lg w-full"
                    >
                </div>

                <input
                    type="submit"
                    value="Crear cuenta"
                    class="bg-indigo-500 hover:bg-indigo-700 transition-colors p-2 rounded-lg w-full text-white uppercase font-bold cursor-pointer"
                >
            </form>
        </div>
    </div>
@endsection
