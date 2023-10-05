@extends('layouts.app')

@section('titulo')
    Crear Publicación
@endsection

@section('contenido')
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush

    <div class="flex flex-col md:flex-row md:justify-center items-center gap-6">
        <!--dropzone-->
        <div class="w-11/12 md:w-6/12 lg:w-4/12 shadow-xl rounded-xl">
            <form action="{{ route('imagenes.store') }}" method="POST" id="dropzone" enctype="multipart/form-data"
                class="dropzone border-dashed border-4 w-full h-80 rounded-xl flex items-center justify-center">
                @csrf
            </form>
        </div>

        <!--formulario para crear un post-->
        <div class="w-11/12 md:w-6/12 lg:w-4/12 bg-white p-6 rounded-lg shadow-xl mt-6 md:mt-0">
            @if (session('mensaje'))
                <p class="bg-rose-600 p-2 text-white text-center mb-4 rounded">{{ session('mensaje') }}</p>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="titulo" class="block mb-2 font-bold uppercase text-gray-500">Titulo</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Titulo de la publicación"
                        class="border p-2 rounded-lg w-full @error('email') border-rose-600 @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block mb-2 font-bold uppercase text-gray-500">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación"
                        class="border p-2 rounded-lg w-full @error('email') border-rose-600 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="text-rose-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Crear Post"
                    class="w-full bg-indigo-500 hover:bg-indigo-700 transition-colors text-white font-bold uppercase py-2 rounded-lg cursor-pointer"
                >
            </form>
        </div>
    </div>
@endsection
