@extends('layouts.app')

@section('titulo')
    Tu cuenta
@endsection

@section('contenido')

    <div class="flex justify-center">

        <div class="w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-6/12 lx:w-4/12 px-5">
                <img
                    src="{{ $user->imagen ? asset('profiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="Imagen usuario"
                    class="rounded-full"
                >
            </div>

            <div class="md:w-6/12 lx:w-4/12 px-5 my-5 text-center md:text-start">

                <div class="flex items-center gap-2 mb-4">
                    <p class="text-gray-600 text-3xl font-medium">
                        {{ $user->username }}    
                    </p>

                    @if (auth()->user()->username === $user->username)
                        <a href="{{ route('editar-perfil.index') }}" class="text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>                              
                        </a>                        
                    @endif
                </div>

                <p class="text-gray-600 text-lg font-bold mb-2">0
                    <span class="font-normal"> Seguidores</span>
                </p>
                <p class="text-gray-600 text-lg font-bold mb-2">0
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-600 text-lg font-bold mb-2">
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>

    </div>

    {{-- Mostrar publicaciones --}}
    <section class="container mx-auto">

        @if ($posts->count())
            <h2 class="text-3xl text-center text-gray-700 font-black my-10">Publicaciones</h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['user' => $user->username, 'post' => $post]) }}">
                            <img src="{{ asset('/uploads') . '/' . $post->imagen }}" alt="Imagen_posts {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="my-6">
                {{ $posts->links('pagination::tailwind')}}
            </div>
        @else
            <p class="text-3xl text-center text-gray-700 font-normal my-10">No hay publicaciones</p>
        @endif

    </section>

@endsection
