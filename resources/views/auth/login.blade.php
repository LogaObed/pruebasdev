@extends('layouts.app')
@section('titulo')
    inicia sesion en DevStagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-1 md:items-center">
        <div class="md:w-6/12 w-full 0 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen">
        </div>
        <div class="md:w-4/12">
            <form action="{{ route('login') }}" method="POST" novalidate
                class="bg-white shadow-xl rounded px-8 pt-6 pb-8 mb-4 ">
                @csrf
                @if (session('mensaje'))
                    <div class="bg-red-600 text-white my-2 rounded-lg p-2 text-sm text-center">{{ session('mensaje') }}</div>
                @endif
                <div class="mb-5">
                    <label class="mb-2 block capitalize text-gray-500 font-bold" for="email">correo</label>
                    <input type="email" value="{{ old('email') }}" id="email" name="email" placeholder="Tu Correo"
                        class="border-2 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 p-2 w-full rounded-lg @error('email') border-red-600 @enderror">
                    @error('email')
                        <div class="bg-red-600 text-white my-2 rounded-lg p-2 text-sm text-center">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="mb-2 block capitalize text-gray-500 font-bold" for="password">contraseña</label>
                    <input type="password" id="password" name="password" placeholder="***********"
                        class="border-2 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 p-2 w-full rounded-lg @error('password') border-red-600 @enderror">
                    @error('password')
                        <div class="bg-red-600 text-white my-2 rounded-lg p-2 text-sm text-center">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> <label class="text-gray-500 font-bold"> Mantener mi sesion abierta </label>
                </div>
                <div class="mb-5">
                    <input type="submit" value="iniciar sesion"
                        class="bg-purple-500 hover:bg-purple-400 transition-colors cursor-pointer capitalize font-bold w-full text-white rounded-lg p-2">
                </div>
            </form>
        </div>
    </div>
@endsection
