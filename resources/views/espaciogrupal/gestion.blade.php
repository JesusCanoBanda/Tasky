<x-app-layout>
    <!-- Enlace al archivo CSS para el estilo de la tabla (si es necesario) -->
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="container">
        <div class="results-table">
            <div class="form-title">Gestión de Espacios Grupales</div>

            @if ($espaciosConMiembros->isNotEmpty())
                @foreach ($espaciosConMiembros as $data)
                    @php
                        $espacio = $data['espacio'];
                        $miembro = $data['miembro'];
                    @endphp

                    <div class="espacio-card">
                        <h3>{{ $espacio->nombre }}</h3>
                        <p>Categoría: {{ $espacio->categoria }}</p>
                        <p>Miembro: {{ $miembro->usuario->name }}</p> <!-- Relación hacia el modelo Usuario -->
                        <p>Rol: {{ $miembro->rol == 1 ? 'Administrador' : 'Miembro' }}</p>

                        <!-- Mostrar opciones solo si el miembro es un usuario regular (rol 0) -->
                        @if ($miembro->rol == 0)
                            <div class="espacio-actions">
                                <!-- Formulario para eliminar la relación del miembro con el espacio -->
                                <form action="{{ route('grupal.miembrodestroy', $miembro->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este miembro del espacio?')">
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
