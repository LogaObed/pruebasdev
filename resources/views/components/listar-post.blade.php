<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <h2 class="text-4xl text-center font-black my-10 capitalize">publicaciones</h2>
    @if ($post->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($post as $posts)
                <div class=" rounded overflow-hidden shadow-lg">
                    <a href="{{ route('post.show', ['post' => $posts, 'user' => $posts->user->username]) }}" class="cursor-pointer">
                        <img class="w-full" src="{{ asset("uploads/$posts->imagen") }}"
                            alt="Imagen del post {{ $posts->titulo }}">
                    </a>
                </div>
            @endforeach

        </div>
        <div class="mt-10">
            {{ $post->links() }}
        </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No Existen Post</p>
    @endif
</div>