@extends('layouts.app')
@section('titulo')
    Bienvenidos
@endsection
@section('contenido')
{{-- enviar calor de la variable a componente --}}
    <x-listar-post :post="$post"/>
    {{-- @forelse ($post as $posts)
        <p>{{ $posts->user->username }}</p>
    @empty
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No Existen Post</p>
    @endforelse --}}
@endsection
