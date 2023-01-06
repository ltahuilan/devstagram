@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex gap-8 md:justify-center">
        <div class="md:w-1/2 lg:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro">
        </div>

        <div class="md:w-1/2 lg:w-4/12 bg-white p-4 rounded-lg shadow-lg">
            <form action="/register" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block text-gray-500 uppercase font-bold">
                        Nombre
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Tu nombre"
                        class="w-full p-2 rounded-lg border @error('name'){{'border-rose-500'}}@enderror"
                        value="{{ old('name') }}"
                    >
                    @error('name')    
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>                    
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block text-gray-500 uppercase font-bold">
                        Username
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Sin espacios, mayúsculas o acentos"
                        class="w-full p-2 rounded-lg border @error('username') {{'border-rose-500'}} @enderror"
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>   
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block text-gray-500 uppercase font-bold">
                        email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu email"
                        class="w-full p-2 rounded-lg border @error('email') {{'border-rose-500'}} @enderror"
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

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block text-gray-500 uppercase font-bold">
                        Confirmar Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirma tu password"
                        class="w-full p-2 rounded-lg border @error('email') {{'border-rose-500'}} @enderror"
                    >
                    @error('password_confirmation')
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Crear Cuenta"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg uppercase font-bold cursor-pointer"
                >
            </form>
        </div>

    </div>
@endsection