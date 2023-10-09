@extends('layouts.app')

@section('titulo')
    Editar perfil: <span class="font-semibold">{{ auth()->user()->username}}</span>
@endsection

@section('contenido')
    <div class="container mt-10">
        <div class="md:w-6/12 mx-auto bg-white p-8 shadow-xl rounded-lg">

            <form action="{{ route('editar-perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block mb-2 font-bold uppercase text-gray-500">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu nuevo username"
                        class="border p-2 rounded-lg w-full @error('username') border-rose-600 @enderror"
                        value="{{ auth()->user()->username }}"
                    >
                    @error('username')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="imagen" class="block mb-2 font-bold uppercase text-gray-500">Imagen</label>
                    <input
                        type="file"
                        id="imagen"
                        name="imagen"
                        accept=".jpg, .jpeg, .png, .webp, .jfif"
                    >
                </div>

                <input
                    type="submit"
                    value="Guardar cambios"
                    class="bg-indigo-500 hover:bg-indigo-700 transition-colors p-2 rounded-lg w-full text-white uppercase font-bold cursor-pointer"
                >

            </form>
            
        </div>
    </div>
@endsection