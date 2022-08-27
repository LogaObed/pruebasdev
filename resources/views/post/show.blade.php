@extends('layouts.app')
@section('titulo')
    {{ $post->titulo }}
@endsection
@section('contenido')
    {{-- publicacion --}}
    {{-- {{$post->likes}} --}}
    <div class="md:flex justify-center">
        <div class="md:w-6/12 p-5">
            <div class="w-full rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{ asset("uploads/$post->imagen") }}" alt="Sunset in the mountains">
                <div class="px-6 py-2">
                    <div class="flex items-center gap-4">
                        @auth
                        <livewire:like-post :post="$post" />
                            {{-- likes --}}
                            {{-- @if ($post->checkLikes(auth()->user()))
                               
                                <form action="{{ route('like.store', $post) }}" method="post">
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif --}}
                        @endauth
                        {{-- <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">@choice('Like|Likes',$post->likes->count())</span></p> --}}
                    </div>
                </div>
                <div class="px-6 py-2">
                    <p class="font-bold text-lg"><a href="{{ route('post.index', $post->user) }}"><span
                                class="font-bold">{{ $post->user->username }}</span></a></p>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="mt-5">{{ $post->descripcion }}</p>
                </div>
                <hr>
                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                    @auth
                        @if ($post->user_id === auth()->user()->id)
                            <form action="{{ route('post.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                                    value="Eliminar Publicaicón">
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        {{-- comentarios --}}
        <div class="md:w-4/12 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
                    @if (session('mensaje'))
                        <p class="bg-green-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">
                            {{ session('mensaje') }}
                        </p>
                    @endif
                    <form action="{{ route('comentario.store', compact('post', 'user')) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 capitalize text-gray-500 font-bold">comentario</label>
                            <textarea name="comentario" id="comentario" cols="30" placeholder="Descripción de la publicación..." style=""
                                class="normal-case border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('comentario') border-red-600 @enderror">{{ old('comentario') }}</textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input type="submit" value="comentar"
                            class="shadow bg-purple-500 hover:bg-purple-400 mt-2 transition-colors cursor-pointer capitalize font-bold w-full p-2.5 text-white rounded-lg">
                    </form>
                @endauth
                <div class="shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        <p class="text-lg font-bold text-center mb-4">Comentarios</p>
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <div class="flex items-center">
                                    <img class="w-10 h-10 rounded-full mr-4" src="{{ $comentario->user->imagen ? asset("perfiles/".$comentario->user->imagen) : asset('img/usuario.svg') }}"
                                        alt="Avatar">
                                    <div class="text-sm">
                                        <p class="text-gray-900 leading-none font-bold mb-2"><a href="{{ route('post.index', $comentario->user) }}">{{ $comentario->user->username }}</a></p>
                                        <p class="text-gray-900 leading-none mb-2">{{ $comentario->comentario }}</p>
                                        <p class="text-gray-600">{{ $comentario->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                {{-- <p class="font-bold"><a
                                        href="{{ route('post.index', $comentario->user) }}">{{ $comentario->user->username }}</a>
                                </p>
                                <p>{{ $comentario->comentario }}</p> --}}
                                {{-- comentario eliminar --}}
                                @auth
                                    @if ($comentario->user_id === auth()->user()->id)
                                        <div class="flex justify-end ">
                                            <form action="{{ route('comentario.destroy', $comentario) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="text-red-500 hover:text-red-600 flex items-center gap-2 ">Eliminar<svg
                                                        xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg></button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- <p class="text-sm text-right text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p> --}}
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-lg font-bold">No exiten comentarios aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
