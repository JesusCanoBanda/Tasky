<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasky - Gestión Simplificada</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-blue-50 text-gray-800">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between py-2 px-6">
            <a href="#" class="text-xl font-bold text-blue-500">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#features" class="hover:text-blue-500 hover:border-b-2 hover:border-blue-600 transition">Características</a></li>
                    <li><a href="#about" class="hover:text-blue-500 hover:border-b-2 hover:border-blue-600 transition">Acerca de</a></li>
                    <li><a href="#contact" class="hover:text-blue-500 hover:border-b-2 hover:border-blue-600 transition">Contacto</a></li>
                </ul>
            </nav>
            <div class="flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-4 py-2 text-blue-600 hover:border-b-2 hover:border-blue-500 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="rounded-md px-4 py-2 text-white bg-green-500 hover:bg-green-600 transition">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="rounded-md px-4 py-2 text-white bg-pink-500 hover:bg-pink-600 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-b from-blue-200 via-blue-100 to-white py-20">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-8 lg:mb-0 text-center lg:text-left">
                <h1 class="text-5xl font-bold text-gray-800 leading-tight">
                    Organiza tu día con <span class="text-blue-500">Tasky</span>
                </h1>
                <p class="mt-6 text-lg text-gray-600">
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

    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-semibold text-gray-800">Por qué elegir Tasky</h2>
            <p class="mt-4 text-gray-600">Tasky hace que la gestión de tareas sea tan sencilla como arrastrar y soltar.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-blue-500">Simplicidad</h3>
                    <p class="mt-4 text-gray-600">Interfaz diseñada para que cualquiera pueda empezar en minutos.</p>
                </div>
                <div class="bg-pink-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-pink-500">Colaboración</h3>
                    <p class="mt-4 text-gray-600">Invita a tus amigos y trabaja juntos en proyectos escolares.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold text-green-500">Progreso</h3>
                    <p class="mt-4 text-gray-600">Visualiza tu avance con gráficos y estadísticas intuitivas.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-16 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2">
            <img src="{{asset('/images/workspaceimage.png') }}" alt="workspace Image" class="rounded-lg shadow-lg">
            </div>
            <div class="lg:w-1/2 lg:pl-16 mt-8 lg:mt-0">
                <h2 class="text-4xl font-semibold text-gray-800">Acerca de Tasky</h2>
                <p class="mt-6 text-gray-600 leading-relaxed">
                    Diseñada pensando en estudiantes, Tasky combina herramientas poderosas con una interfaz amigable y accesible. Desde tareas individuales hasta proyectos colaborativos, lo tendrás todo organizado.
                </p>
                <a href="#contact" class="mt-6 inline-block bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600">
                    Contáctanos
                </a>
            </div>
        </div>
    </section>

    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-semibold text-gray-800">¿Tienes preguntas?</h2>
            <p class="mt-4 text-gray-600">¡Déjanos un mensaje y te responderemos pronto!</p>
            <form action="#" method="POST" class="mt-8 max-w-lg mx-auto">
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Tu nombre" class="w-full p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Tu correo electrónico" class="w-full p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <textarea name="message" rows="4" placeholder="Tu mensaje" class="w-full p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600">
                    Enviar
                </button>
            </form>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Tasky. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
