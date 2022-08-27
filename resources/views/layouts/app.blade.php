<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    {{-- seccion para los estimos  --}}
    @stack('styles')
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-purple-300 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{route('home')}}" class="text-3xl font-black"> DevsTagram</a>
            <nav class="uppercase flex gap-3 font-bold text-gray-600 text-sm items-center">
                @auth
                    {{-- autenticado --}}
                    <a href="{{route('post.create')}}" class="cursor-pointer flex items-center gap-2 border  p-2 rounded-lg text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>crear</a>
                    <a href="{{ route('post.index', auth()->user()->username) }}" class="capitalize">hola:
                        {{ auth()->user()->username }}</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" class="uppercase cursor-pointer" value="cerrar sesion">
                    </form>
                @endauth
                @guest
                    {{-- no autenticado --}}
                    <a href="{{ route('login') }}" class="">iniciar sesion</a>
                    <a href="{{ route('register') }}" class="">crear cuenta</a>
                @endguest
            </nav>
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10 capitalize">@yield('titulo')</h2>
        @yield('contenido')
    </main>
    <footer class="uppercase text-center p-5 mt-10 text-gray-600 font-bold ">
        DevsTagram todos los derechos reservados {{ now()->year }}
    </footer>
    @livewireScripts
</body>

</html>
