@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex gap-8">

        <div class="md:w-6/12 text-center md:text-start">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen de {{ $post->titulo }}">
            <div class="my-4 flex gap-2 justify-center md:justify-start">
                <form action="">
                    @csrf
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </button>
                </form>
                <p>0 likes</p>                  
            </div>
            <a href="{{ route('posts.index', $post->user->username) }}" class="text-lg font-bold">
                {{ $post->user->username }}
            </a>
            <p class="text-sm text-gray-500 font-semibold">{{ $user->created_at->diffForHumans() }}</p>
            <p class="text-xl mt-2">{{ $post->descripcion }}</p>

            @auth
                @if (auth()->user()->username === $user->username)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" >
                        {{-- Method Spoofing --}}
                        @method('DELETE')                        
                        @csrf
                        <input
                            type="submit"
                            value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600 transition-colors text-white font-semibold py-2 px-4 my-6 rounded-lg cursor-pointer">
                    </form>                    
                @endif
            @endauth

        </div>

        <div class="md:w-6/12 mt-10 md:mt-0">
            <div class="bg-white p-6 rounded-lg shadow-xl">

                @auth
                    <p class="text-center text-2xl font-bold text-gray-700 mb-6">Comentar publicación</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 text-white text-center font-bold p-2 mb-4 rounded-lg">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['user' => $user->username, 'post' => $post]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="comentario" class="block mb-2 font-bold uppercase text-gray-500">Agrega un
                                comentario</label>
                            <input type="text" id="comentario" name="comentario" placeholder="Comentario"
                                class="border p-2 rounded-lg w-full @error('comentario') border-rose-600 @enderror">
                            @error('comentario')
                                <p class="text-rose-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="w-full bg-indigo-500 hover:bg-indigo-700 transition-colors text-white font-semibold uppercase py-2 rounded-lg cursor-pointer">
                    </form>
                @endauth

                @guest
                    <p class="text-center text-xl font-bold text-gray-700 mb-6">No has iniciado sesión</p>
                @endguest

                <div>
                    @if ($post->comentarios)
                        @foreach ($post->comentarios as $comentario)
                            <div class="border-b border-gray-400 p-2">
                                <a href="{{ route('posts.index', $comentario->user->username) }}" class="font-bold cursor-pointer hover:text-indigo-700">{{ $comentario->user->username}}</a>
                                <p>{{ $comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p>No hay comentarios aún...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
