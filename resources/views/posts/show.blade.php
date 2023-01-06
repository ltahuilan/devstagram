@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')

    <div class="container mx-auto md:flex gap-6">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads' . '/' . $post->imagen) }}" alt="Imagen del post {{$post->titulo}}">
            <div class="mt-3">
                <div class="p-3 flex gap-2">

                    {{-- solo los usuarios autenticados pueden dar like a la publicación --}}
                    @auth
                        {{-- {{ dd($post->checkLikes(auth()->user()) ) }} --}}

                        @if ($post->checkLikes( auth()->user() ))

                            <form action="{{ route('posts.like.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>                       
                                </button>
                            </form>

                        @else

                            <form action="{{ route('posts.like.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>                       
                                </button>
                            </form> 
                                                   
                        @endif

                    @endauth
                    <p>0 Liks</p>
                </div>

                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-gray-600 text-sm">
                    {{ $post->created_at->diffForHumans() /*https://carbon.nesbot.com/docs/#api-humandiff*/}}
                </p>
                <p class="mt-4 text-2xl">{{ $post->descripcion}}</p>

            </div>
            @auth
                <div>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        {{-- METHOD SPOOFING --}}
                        @method('DELETE')
                        @csrf
                        <input
                            type="submit"
                            value="Eliminar Publicación"
                            class="bg-red-500 p-2 text-white font-bold rounded-lg mt-6 cursor-pointer"
                        >
                    </form>
                </div>                
            @endauth
        </div>
        <div class="md:w-1/2">
            @auth
                <div class="p-2 bg-white shadow-xl">
                    <p class="text-center font-bold text-2xl mb-6">Agregar un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 text-white p-2 mb-6 text-center uppercase rounded-lg">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['user'=>$user, 'post'=>$post]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block text-gray-500 uppercase font-bold">
                                Comentario:
                            </label>
                            <input
                                type="text"
                                id="comentario"
                                name="comentario"
                                placeholder="Agrega un comentario"
                                class="w-full p-2 rounded-lg border @error('titulo'){{'border-rose-500'}}@enderror"
                            >
                        </div>
                        
                        @error('comentario')    
                            <p class="bg-rose-500 text-white text-center p-2 my-2 rounded-lg">{{$message}}</p>                    
                        @enderror

                        <input
                        type="submit"
                        value="Comentar"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg uppercase font-bold cursor-pointer"
                        >
                    </form>
                </div>
            @endauth
            <div class="bg-with rounded-lg shadow-xl p-2 mt-6 overflow-scroll h-96">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario )
                        <div class="p-2 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user)}}" class="font-bold">{{ $comentario->user->username }}</a>
                            <p class="text-lg">{{$comentario->comentario}}</p>
                            <p class="text-gray-600 text-sm">{{$comentario->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600 font-bold text-center">Aún no hay comentarios</p>
                @endif
            </div>
        </div>

        {{-- {{ dd($post->comentarios->count()) }} --}}
    </div>

@endsection