<div>
    @if ($posts->count())
        <h2 class="text-3xl text-center text-gray-700 font-black my-10">Publicaciones</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
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

</div>