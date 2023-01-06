<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        @vite('resources/css/app.css')
        {{-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> --}}
        <title>DevStagram - @yield('titulo')</title>

    </head>
    <body class="bg-gray-100">
        <header class="p-5 bg-white shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black"><a href="/">DevStagram</a></h1>

                {{-- @if(auth()->user())
                    <p>Autenticado</p>
                @else
                    <p>NO autenticado</p>
                @endif --}}
                
                {{--Mostrar opciones de navegacion se esta autenticado--}}
                @auth
                    <nav class="flex items-center gap-6">
                        <a 
                            href="{{route('posts.create')}}"
                            class=" flex items-center gap-2 p-2 border border-gray-600 rounded-lg cursor-pointer text-gray-600 text-xs font-bold uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>                              
                            Crear
                        </a>

                        <a class="text-sm font-bold text-gray-600" href="{{ route('posts.index', auth()->user()->username) }}">
                            Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                        </a>

                        {{--Cierre de sesion con un form para para acceder a la directiva @csrf--}}
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="text-xs font-bold uppercase text-gray-600">
                                Cerrar Sesión
                            </button>
                        </form>
                    </nav>
                @endauth

                {{--Mostrar opciones de navegación si no esta autenticado--}}
                @guest
                    <nav class="flex gap-6">
                        <a class="text-xs font-bold uppercase text-gray-600" href="{{route('login')}}">
                            Iniciar sesión
                        </a>
                        <a class="text-xs font-bold uppercase text-gray-600" href="{{ route('register') }}">
                            Crear cuenta
                        </a>
                    </nav>
                @endguest

            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            {{-- Insetar el contenido de las páginas --}}
            @yield('contenido')
        </main>

        <footer class="mt-12 text-center font-bold text-gray-500 uppercase">
            Todos los derechos reservados {{now()->year}}
        </footer>
        
        @stack('sripts')
    </body>

</html>