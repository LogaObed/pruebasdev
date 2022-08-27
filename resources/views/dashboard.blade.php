@extends('layouts.app')
@section('titulo')
    perfil: {{ $user->username }}
@endsection
@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class="rounded-full"
                    src="{{ $user->imagen ? asset("perfiles/$user->imagen") : asset('img/usuario.svg') }}"
                    alt="Perfil {{ $user->username }}">
            </div>
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center gap-3">
                    <p class="text-gray-700 text-2xl mb-5">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.edit', compact('user')) }}"
                                class="text-gray-800 text-sm mb-3 font-bold"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg></a>
                        @endif
                    @endauth
                                                                                           {{-- filtra datos segun el contador  @choice--}}
                </div>                                                                                                      
                <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->followers->count()}} <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->follogins->count()}} <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->post->count() }} <span class="font-normal">Posts</span></p>
                @auth
                    @if (auth()->user()->id != $user->id)
                        @if (!$user->seguidor(auth()->user()))
                            <form action="{{ route('follower.store', compact('user')) }}" method="POST">
                            @csrf
                            <input type="submit"
                                class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                value="Seguir">
                            </form>
                       @else
                                <form action="{{ route('follower.destroy', compact('user')) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit"
                                        class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                        value="dejar de Seguir">
                                </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <x-listar-post :post="$post"/>
    </section>
@endsection
