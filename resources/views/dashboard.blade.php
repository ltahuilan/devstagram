@extends('layouts.app')

@section('titulo')
    Tu cuenta
@endsection

@section('contenido')

    <div class="flex justify-center">

        <div class="w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-6/12 lx:w-4/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen usuario">
            </div>
            <div class="md:w-6/12 lx:w-4/12 px-5 my-5 text-center md:text-start">
                <p class="text-gray-600 text-3xl font-medium my-4">
                    {{ $user->username }}
                </p>

                <p class="text-gray-600 text-lg font-bold mb-2">0
                    <span class="font-normal"> Seguidores</span>
                </p>
                <p class="text-gray-600 text-lg font-bold mb-2">0
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-600 text-lg font-bold mb-2">0
                    <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>

    </div>

    {{-- Mostrar publicaciones --}}
    <section class="container mx-auto">

        @if ($posts->count())
            <h2 class="text-3xl text-center text-gray-700 font-black my-10">Publicaciones</h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
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
