<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-8 px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <h3 class="text-4xl font-bold text-gray-700">{{ __("Bienvenido a TASKY!") }}</h3>
                <p class="mt-2 text-lg text-gray-500">{{ __("Gestiona tareas, proyectos y más desde un lugar centralizado.") }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('table.index') }}" class="block">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition duration-300">
                        <h4 class="text-xl font-bold">Espacio Personal</h4>
                        <p class="mt-2 text-sm text-blue-100">Organiza tus tareas personales en un espacio dedicado.</p>
                        <div class="mt-4 flex justify-center">
                            <img src="{{ asset('images/user.png') }}" alt="Personal" class="w-14 h-14 rounded-full">
                        </div>
                    </div>
                </a>

                <a href="{{ route('grupal.index') }}" class="block">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition duration-300">
                        <h4 class="text-xl font-bold">Espacio Grupal</h4>
                        <p class="mt-2 text-sm text-green-100">Colabora con tu equipo y mantén todo organizado.</p>
                        <div class="mt-4 flex justify-center">
                            <img src="{{ asset('images/group.png') }}" alt="Grupal" class="w-14 h-14 rounded-full">
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-2xl font-bold text-gray-700">Tus Workspaces</h3>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="{{ route('table.index') }}" class="block text-blue-500 hover:text-blue-600">Workspace #1</a>
                    </li>
                    <li>
                        <a href="#" class="block text-green-500 hover:text-green-600">Workspace #2</a>
                    </li>
                    <li>
                        <a href="#" class="block text-pink-500 hover:text-pink-600">Workspace #3</a>
                    </li>
                </ul>
            </div>

            @auth
                @if(auth()->user()->isAdmin())
                    <div class="bg-gray-50 rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-700">Panel de Administración</h3>
                        <ul class="mt-4 space-y-2">
                            <li>
                                <a href="{{ route('admin.index') }}" class="block text-red-500 hover:text-red-600">Administrar Usuarios</a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</x-app-layout>
