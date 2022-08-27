@extends('layouts.app')
{{-- recinir los estilos  --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('titulo')
crear nueva publicación 
@endsection
@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-6/12 px-10">
        <form action="{{ route('imagen.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
            class="dropzone border-dashed border-purple-500 border-2 w-full h-96 flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>
    <div class="md:w-4/12 bg-white mx-3 p-6 rounded-lg shadow-lg mt-5 md:mt-0">
        <form class="w-full" action="{{route('post.store')}}" method="post" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 capitalize text-gray-500 font-bold">titulo</label>
                <input value="{{ old('titulo') }}" type="text" placeholder="Titulo de la publicación..." name="titulo"
                    id="titulo"
                    class="normal-case border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('titulo') border-red-600 @enderror">
                @error('titulo')
                <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="mb-2 capitalize text-gray-500 font-bold">descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" placeholder="Descripción de la publicación..."
                    class="normal-case border p-2.5 w-full rounded-lg shadow-sm focus:outline-none focus:bg-white focus:border-purple-500 @error('descripcion') border-red-600 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="hidden" name="imagen" id="imagen" value="{{old('imagen')}}">
                @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-sm text-sm p-2 text-center normal-case">{{ $message }}
                </p>
                @enderror
            </div>
            <input type="submit" value="publicar"
                class="shadow bg-purple-500 hover:bg-purple-400 mt-2 transition-colors cursor-pointer capitalize font-bold w-full p-2.5 text-white rounded-lg">
        </form>
    </div>
</div>
@endsection
