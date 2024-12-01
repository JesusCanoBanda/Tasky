<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="py-12 bg-blue-50 min-h-screen jus">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gradient-to-r from-teal-400 to-blue-500 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <div class="text-center text-white">
                    <h3 class="text-3xl font-semibold">{{ __("Bienvenido a TASKY!") }}</h3>
                    <p class="mt-4 text-lg text-black-500">{{ __("Aquí puede administrar sus tareas, proyectos y más.") }}</p>
                </div>
            </div>

            <div class="p-4 text-gray-900 bg-gradient-to-r from-blue-500 rounded-lg shadow-lg max-w-xs mx-auto">
                <h3 class="text-xl font-semibold text-center text-white">{{ __("Crea un espacio de trabajo") }}</h3>
            </div>


            <div class="card-container">
                <a href="{{ route('table.index') }}" class="card-link">
                    <div class="card" style="background-color: #A7C7E7">
                        <div class="container">
                            <h4 class="title"><b>Espacio de Trabajo</b></h4>
                            <h4 class="name"><b>Personal</b></h4>
                            <img class="img" src="{{ asset('images/user.png') }}">
                        </div>
                    </div>
                </a>

                <a href="{{ route('grupal.index') }}" class="card-link">
                    <div class="card" style="background-color: #A8E6CF;">
                        <div class="container">
                            <h4 class="title"><b>Espacio de Trabajo</b></h4>
                            <h4 class="name2"><b>Grupal</b></h4>
                            <img class="img" src="{{ asset('images/group.png') }}">
                        </div>
                    </div>
                </a>
            </a>
            </div>

           <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('table.index') }}" class="block">
                    <div class="bg-pink-50 p-6 rounded-lg shadow-md hover:bg-pink-100 transition duration-200">
                        <h4 class="text-lg font-semibold text-black"  style="text-align: center">Espacio de Trabajo</h4>
                        <h4 class="text-lg font-semibold text-blue-600" style="text-align: center">Personal</h4>
                    </div>
                </a>

                <a href="{{ route('table.index') }}" class="block" role="button">
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:bg-green-100 transition duration-200">
                        <h4 class="text-lg font-semibold text-green-600">Project</h4>
                        <p class="text-gray-600">Project name #2</p>
                    </div>
                </a>

                <a href="{{ route('table.index') }}" class="block">
                    <div class="bg-blue-50 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-black"  style="text-align: center">Espacio de Trabajo</h4>
                        <h4 class="text-lg font-semibold text-red-600" style="text-align: center">Grupal</h4>
                    </div>
                </a>

            </div> -->

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold text-gray-800">Work spaces</h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="{{ route('table.index') }}" class="text-blue-500 hover:text-blue-600">Work Space #1</a>
                        </li>
                        <li>
                            <a href="#" class="text-green-500 hover:text-green-600">Work Space #2</a>
                        </li>
                        <li>
                            <a href="#" class="text-pink-500 hover:text-pink-600">Work Space #3</a>
                        </li>
                    </ul>
                </div>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <div>
                        <li>
                            <a href="{{ route('admin.index') }}">Administrar Usuarios</a>
                        </li>
                    </div>
                @endif
            @endauth

        </div>
    </div>
</x-app-layout>
