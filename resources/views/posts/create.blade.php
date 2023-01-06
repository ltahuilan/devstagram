@extends('layouts.app')

@section('titulo')
    Crea una publicación
@endsection

@section('contenido')
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />        
    @endpush

    <div class="md:flex md:items-center md:gap-10">
        <div class="md:w-1/2 lg:w-5/12 mb-10 md:mb-0 h-90">
            <form
                action="{{ route('imagenes.store') }}"
                method="POST"
                enctype="multipart/forma-data"
                id="dropzone"
                class="dropzone bg-white font-bold text-gray-500 border-dashed border-3 w-full h-80 rounded flex justify-center items-center"
            >
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 lg:w-5/12 p-10 bg-white rounded-lg shadow-xl">
            <form method="POST" action="{{route('posts.store')}}" novalidate>
                @csrf
    
                @if (session('mensaje'))
                    <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{session('mensaje')}}</p>
                @endif
    
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block text-gray-500 uppercase font-bold">
                        Título:
                    </label>
                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        placeholder="Titulo de la publicación"
                        class="w-full p-2 rounded-lg border @error('titulo'){{'border-rose-500'}}@enderror"
                        value="{{ old('titulo') }}"
                    >
                    @error('titulo')    
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>                    
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block text-gray-500 uppercase font-bold">
                        Descripción:
                    </label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        placeholder="Descripción de la publicación"
                        class="w-full p-2 rounded-lg border @error('descripcion'){{ 'border-rose-500' }}@enderror"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')    
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>                    
                    @enderror
                </div>

                <div class="mb-5">
                    <input 
                        type="hidden"
                        name="imagen"
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                        <p class="bg-rose-500 text-white text-center p-2 mt-2 rounded-lg">{{$message}}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Publicar"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg uppercase font-bold cursor-pointer"
                >

            </form>
        </div>
    </div>
@endsection

@push('sripts')
    @vite('resources/js/app.js')    
@endpush