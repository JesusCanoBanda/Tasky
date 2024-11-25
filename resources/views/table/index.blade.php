<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="layout">
        <div class="sidebar">
            <a href="#" class="title">Espacios</a>
            <hr>
            @if ($espacios->isNotEmpty())
                @foreach ($espacios as $espacio)
                    <a href="#" class="space-name" onclick="loadEspacio({{ $espacio->id }})">{{ $espacio->nombre }}</a>
                    <form action="{{ route('espaciopersonal.destroy', $espacio->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este espacio?')">Eliminar</button>
                    </form>
                    <form action="{{ route('espaciopersonal.edit', $espacio->id) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Editar</button>
                    </form>
                @endforeach
            @else
                <p class="no-spaces">No tienes espacios creados aún.</p>
            @endif
            <hr>
            <a href="{{ route('espaciopersonal.create') }}" class="create-space">+ Crear espacio</a>
        </div>

        <div class="main-content">
            <div id="espacio-content">
                <!-- Aquí se cargarán los datos del espacio seleccionado -->
                <p>Selecciona un espacio para ver los detalles.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadEspacio(id) {
            // Realizar una solicitud AJAX para obtener los datos del espacio
            $.ajax({
                url: `/table/${id}`, // Ruta al controlador
                type: 'GET',
                success: function(data) {
                    // Actualizar el contenido de #espacio-content con los datos del espacio
                    $('#espacio-content').html(`
                        <h1>${data.nombre}</h1>
                        <p>Categoría: ${data.categoria}</p>
                        <p>Creado en: ${data.created_at}</p>
                    `);
                },
                error: function(xhr) {
                    // Manejar errores
                    console.error('Error al cargar el espacio:', xhr);
                    alert('No se pudo cargar el espacio. Inténtalo de nuevo.');
                }
            });
        }
    </script>
</x-app-layout>
