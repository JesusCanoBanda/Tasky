<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasky - Gestión Simplificada</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#1E0579] via-[#2B105A] to-[#421F88] text-gray-200">
<header class="bg-gradient-to-r from-[#1E0579] via-[#2A175E] to-[#120442] shadow-lg">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo -->
        <a href="#" class="text-2xl font-bold text-white flex items-center gap-2">
            <x-application-logo class="w-10 h-10 fill-current text-blue-300" />
            <span>Tasky</span>
        </a>
        
        <!-- Navegación -->
        <nav>
            <ul class="flex space-x-6 text-white">
                <li>
                    <a href="#features" 
                       class="hover:text-blue-300 hover:border-b-2 hover:border-blue-400 transition duration-200">
                       Características
                    </a>
                </li>
                <li>
                    <a href="#about" 
                       class="hover:text-blue-300 hover:border-b-2 hover:border-blue-400 transition duration-200">
                       Acerca de
                    </a>
                </li>
                <li>
                    {{-- <a href="#contact" 
                       class="hover:text-blue-300 hover:border-b-2 hover:border-blue-400 transition duration-200">
                       Contacto
                    </a> --}}
                </li>
            </ul>
        </nav>

        <!-- Acciones -->
        <div class="flex space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="px-4 py-2 text-white hover:text-blue-300 hover:border-b-2 hover:border-blue-300 transition">
                       Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="rounded-md px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 transition">
                       Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="rounded-md px-4 py-2 text-white bg-green-600 hover:bg-green-700 transition">
                           Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</header>


    <section class="bg-gradient-to-b from-[#1E0579] via-[#2B105A] to-[#421F88] py-20 text-gray-200">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-8 lg:mb-0 text-center lg:text-left">
                <h1 class="text-5xl font-bold leading-tight">
                    Organiza tu día con <span class="text-blue-300">Tasky</span>
                </h1>
                <p class="mt-6 text-lg">
                    La herramienta más simple y poderosa para estudiantes que buscan organizar tareas y proyectos sin complicaciones.
                </p>
                <a href="#features" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600">
                    Descubre más
                </a>
            </div>
            <div class="lg:w-1/2">
                <img src="{{asset('/images/organizeimagen.png') }}" alt="Organize Image" class="rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <section id="features" class="py-16 bg-[#2A175E]">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-semibold text-white">Por qué elegir Tasky</h2>
            <p class="mt-4 text-gray-300">Tasky hace que la gestión de tareas sea tan sencilla como arrastrar y soltar.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="bg-[#3B216E] p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-blue-300">Simplicidad</h3>
                    <p class="mt-4 text-gray-300">Interfaz diseñada para que cualquiera pueda empezar en minutos.</p>
                </div>
                <div class="bg-[#522780] p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-pink-400">Colaboración</h3>
                    <p class="mt-4 text-gray-300">Invita a tus amigos y trabaja juntos en proyectos escolares.</p>
                </div>
                <div class="bg-[#3B216E] p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-green-400">Progreso</h3>
                    <p class="mt-4 text-gray-300">Visualiza tu avance con gráficos y estadísticas intuitivas.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-16 bg-gradient-to-b from-[#2A175E] to-[#1E0579] text-gray-200">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2">
                <img src="{{asset('/images/workspaceimage.png') }}" alt="workspace Image" class="rounded-lg shadow-lg">
            </div>
            <div class="lg:w-1/2 lg:pl-16 mt-8 lg:mt-0">
                <h2 class="text-4xl font-semibold">Acerca de Tasky</h2>
                <p class="mt-6 leading-relaxed">
                    Diseñada pensando en estudiantes, Tasky combina herramientas poderosas con una interfaz amigable y accesible. Desde tareas individuales hasta proyectos colaborativos, lo tendrás todo organizado.
                </p>
                <a href="#contact" class="mt-6 inline-block bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600">
                    Contáctanos
                </a>
            </div>
        </div>
    </section>


    <footer class="bg-[#1E0579] text-gray-200 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Tasky. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
