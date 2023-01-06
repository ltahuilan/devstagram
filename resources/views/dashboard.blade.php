@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center items-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 flex ">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen usuario">
            </div>
            
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col justify-center items-center md:items-start">
                <p class="text-gray-800 text-2xl">{{ $user->username }}</p>
                <p class="text-gray-800 font-bold text-sm mb-3 mt-5">0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 font-bold text-sm mb-3">0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 font-bold text-sm mb-3">0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section>
        <h2 class="text-3xl text-center font-black my-10">Publicaciones</h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ( $posts as $post )
                    <div>
                        <a href="{{ route('posts.show', ['user' => $user, 'post' => $post])}}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">                
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $posts->links('pagination::tailwind')}}
            </div>
        @else
            <p class="text-gray-600 font-bold text-center text-sm">Aún no tienes publicaciones</p>
            <a href="{{ route('posts.create')}}">
                <p class="text-gray-600 font-bold text-center mt-2">Comienza creando una...</p>
            </a>      
        @endif
    </section>
@endsection

