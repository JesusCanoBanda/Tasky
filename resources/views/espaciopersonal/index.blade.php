<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="layout">
        <div class="sidebar">
            <a href="#" class="title">Espacios</a>
            <hr>
            @if ($espacios->isNotEmpty())
                @foreach ($espacios as $espacio)

                    <button class="space-name" onclick="loadEspacio({{ $espacio->id }})">{{ $espacio->nombre }}</button>

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

            <br>
            
            <div class="table">
                <table>

                    <thead id="tareas-header">
                        <!--mejor le hubieramos metido react nenes -->
                    </thead>

                    <tbody id="tareas-list">
                        <!-- aqui van las tareas dinamicamente nenes pa que no le metan si no  los descuento-->
                    </tbody>

                </table>
            </div>

        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
       function loadEspacio(id) { //estas cosas ya son como componentes todos feos con jquery xd
        $.ajax({
            url: `/personal/${id}`, //esta vaina es el controlador de espaciopersonal  en show
            type: 'GET',
            success: function(response) {
                const espacio = response.espacio;
                const tareas = response.tareas;

                $('#espacio-content').html(`
                    <h1>${espacio.nombre}</h1>
                    <p>Categoría: ${espacio.categoria}</p>
                    <p>Creado en: ${espacio.created_at}</p>
                    <p>Tareas</p>
                    <a href="/personal/${espacio.id}/crear">Agregar Tarea </a>
                `);

                $('#tareas-header').html(
                            `<tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha final</th>
                            <th>Descripción</th>
                            <th>Estado </th>
                            <th>Porcentaje </th>
                            <th>Acciones</th>
                            </tr>`);

                let tareasHtml = '';
                tareas.forEach((tarea)=> { //vivan las arrow function
                    tareasHtml += `
                        <tr>
                            <td>${tarea.id} </td>
                            <td>${tarea.nombre}</td>
                            <td>${tarea.fecha_inicio}</td>
                            <td>${tarea.fecha_final}</td>
                            <td>${tarea.descripcion}</td>
                            <td>${tarea.estado}</td>
                            <td>${tarea.porcentaje}</td>

                            <td>
                            <a href="/personal/${tarea.id}/editar">Editar</a>
                            
                            <form action="{{ url('/personal/${tarea.id}/eliminar') }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');" class="delete-button">
                                        Eliminar
                                    </button>
                            </form>

                            </td>
                        </tr>
                    `;
                });

                $('#tareas-list').html(tareasHtml); 
        },
        error: function(xhr) {
            console.error('Error al cargar los datos:', xhr);
            alert('No se pudo cargar el espacio o las tareas. Inténtalo de nuevo.');
        }
        });
    }
    </script>

        <style>
            #tareas {
            max-height: 300px; /* Ajusta según el tamaño deseado */
            overflow-y: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th {
                position: sticky;
                top: 0;
                background-color: #f8f9fa; /* Fondo del header */
                z-index: 1;
                padding: 10px;
                text-align: left;
                border-bottom: 2px solid #ddd;
            }

            td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
    
</x-app-layout>
