<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/gestion.css') }}">

    <div class="container">

        <a class="absolute top-3 right-[-530px] w-12 h-12 flex items-center justify-center text-red-500 hover:text-gray-600"
            href="{{ route('grupal.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <div class="results-table">
            <div class="form-title">Gestión de Espacios Grupales</div>

            @if ($espaciosConMiembros->isNotEmpty())
                @foreach ($espaciosConMiembros as $data)
                    @php
                        $espacio = $data['espacio'];
                        $miembro = $data['miembro'];
                    @endphp

                    <div class="espacio-card">
                        <h3 style="font-size: 20px; color: blue"><b>{{ $espacio->nombre }}</b></h3>
                        <p><b>Categoría:</b> {{ $espacio->categoria }}</p>
                        <p><b>Miembro: </b>{{ $miembro->usuario->name }}</p> <!-- Relación hacia el modelo Usuario -->
                        <p><b>Rol:</b> {{ $miembro->rol == 1 ? 'Administrador' : 'Miembro' }}</p>

                        <!-- Mostrar opciones solo si el miembro es un usuario regular (rol 0) -->
                        @if ($miembro->rol == 0)
                            <div class="espacio-actions">
                                <!-- Formulario para eliminar la relación del miembro con el espacio -->
                                <form action="{{ route('grupal.miembrodestroy', $miembro->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="eliminar"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este miembro del espacio?')">
                                        Eliminar miembro
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>No tienes miembros en tus espacios grupales.</p>
            @endif
        </div>
    </div>
</x-app-layout>
