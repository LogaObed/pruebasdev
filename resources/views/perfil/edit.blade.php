@extends('layouts.app')
@section('titulo')
    Editar perfil: {{ $user->username }}
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-4  md:items-center">
        <div class="md:w-4/12  bg-white mx-3 p-6 rounded-lg shadow-lg">
            <form enctype="multipart/form-data" class="w-full max-w-sm" action="{{route('perfil.update',compact('user'))}}" method="post" novalidate>
               @method('PUT')
                @csrf
                {{-- <div class="mb-5">
                    <label for="name" class="mb-2 capitalize text-gray-500 font-bold">Nombre</label>
                    <input value="{{ $user->name }}" type="text" placeholder="Obed Loeza ..." name="name"
                        id="name"
                        class="capitalize border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('name') border-red-600 @enderror">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                        </p>
                    @enderror
                </div> --}}
                <div class="mb-5">
                    <label for="username" class="mb-2 capitalize text-gray-500 font-bold">Nombre usuario</label>
                    <input value="{{ $user->username }}" type="text" placeholder="Obed Loeza ..." name="username"
                        id="username"
                        class="border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('username') border-red-600 @enderror">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 capitalize text-gray-500 font-bold">imagen</label>
                    <input type="file" name="imagen" id="imagen" accept=".jpg,.png,.jpeg"
                        class="capitalize border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('imagen') border-red-600 @enderror" >
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Editar Cuenta"
                    class="shadow bg-purple-500 hover:bg-purple-400 mt-2 transition-colors cursor-pointer capitalize font-bold w-full p-2.5 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection
