<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="layout overflow-hidden">
    <div class="bg-gradient-to-b from-[#1E0579] via-[#2E1461] to-[#421F88] text-white w-72 h-full overflow-hidden p-6 flex flex-col justify-between shadow-xl">
    <div>
        <!-- Logo y Título -->
        <div class="flex items-center gap-3 mb-8">
            <h1 class="text-xl font-bold tracking-wider uppercase">Espacio Personal</h1>
        </div>

        <hr class="border-gray-600 mb-6">

        <!-- Espacios -->
        <div class="space-y-4">
            @if ($espacios->isNotEmpty())
                @foreach ($espacios as $espacio)
                    <button class="flex items-center gap-3 py-3 px-4 w-full text-left bg-[#3F3F5A] hover:bg-[#505070] rounded-lg transition-all duration-200"
                            onclick="loadEspacio({{ $espacio->id }}); toggleActions({{ $espacio->id }})"> <!-- Llamada a toggleActions y loadEspacio -->
                        <span class="text-sm font-medium">{{ $espacio->nombre }}</span>
                    </button>

                    <!-- Botones de acciones (ocultos por defecto) -->
                    <div id="actions-{{ $espacio->id }}" class="hidden flex gap-2 mt-2">
                        <form action="{{ route('espaciopersonal.destroy', $espacio->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center gap-2 py-2 px-3 bg-red-500 text-white rounded-lg hover:bg-red-600 w-full transition-all duration-200"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este espacio?')">
                                    <span class="text-sm font-medium">Eliminar</span>
                                </button>
                        </form>
                        <form action="{{ route('espaciopersonal.edit', $espacio->id) }}" method="GET" class="w-full">
                            <button type="submit"
                                    class="flex items-center gap-2 py-2 px-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 w-full transition-all duration-200">
                                    <span class="text-sm font-medium">Editar</span>
                                </button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-400 text-center">No tienes espacios creados aún.</p>
            @endif
        </div>

        <hr class="border-gray-600 my-6">

        <!-- Botones para Crear o Unirse a un Espacio -->
        <button type="button" class="bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 w-full mb-4 transition-all duration-200" onclick="openModal()">
            + Crear Espacio
        </button>

    </div>
</div>

<!-- Contenido Principal -->

<script>
    function toggleActions(espacioId) {
        const actionDiv = document.getElementById(`actions-${espacioId}`);
        const allActionDivs = document.querySelectorAll('[id^="actions-"]');

        // Ocultar todas las acciones
        allActionDivs.forEach(div => {
            if (div.id !== `actions-${espacioId}`) {
                div.classList.add('hidden');
            }
        });

        // Alternar visibilidad de las acciones seleccionadas
        if (actionDiv.classList.contains('hidden')) {
            actionDiv.classList.remove('hidden');
        } else {
            actionDiv.classList.add('hidden');
        }
    }

    function loadEspacio(id) { 
        $.ajax({
            url: `/personal/${id}`,
            type: 'GET',
            success: function(response) {
                const espacio = response.espacio;
                const tareas = response.tareas;

                $('#espacio-content').html(`
                    <div class="card">
                    <h1 class="name">${espacio.nombre}</h1>
                    <p><span class="bold">Categoría: </span>${espacio.categoria}</p>
                    <p><span class="bold">Creado en: </span>${new Date(espacio.created_at).toLocaleDateString()}</p>
                    </div>
                    <a href="/personal/${espacio.id}/crear" class="task">Agregar Tarea </a>
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
                tareas.forEach((tarea) => { 
                    tareasHtml += `
                        <tr>
                            <td class="cont">${tarea.id} </td>
                            <td class="cont">${tarea.nombre}</td>
                            <td class="cont">${new Date(tarea.fecha_inicio).toLocaleDateString()}</td>
                            <td class="cont">${new Date(tarea.fecha_final).toLocaleDateString()}</td>                            
                            <td class="cont">${tarea.descripcion}</td>
                            <td class="cont">${tarea.estado}</td>
                            <td class="cont">${tarea.porcentaje}</td>

                            <td>
                            <a href="/personal/${tarea.id}/editar" class="editar">Editar</a>
                            
                            <form action="{{ url('/personal/${tarea.id}/eliminar') }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');" class="eliminar">
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


        <div class="main-content">
            <div id="espacio-content">
                <!-- Aquí se cargarán los datos del espacio seleccionado -->
                <p class="message">Selecciona un espacio para ver los detalles.</p>
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
                    <div class="card">
                    <h1 class="name">${espacio.nombre}</h1>
                    <p><span class="bold">Categoría: </span>${espacio.categoria}</p>
                    <p><span class="bold">Creado en: </span>${new Date(espacio.created_at).toLocaleDateString()}</p>
                    </div>
                    <a href="/personal/${espacio.id}/crear" class="task">Agregar Tarea </a>
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
                            <td class="cont">${tarea.id} </td>
                            <td class="cont">${tarea.nombre}</td>
                            <td class="cont">${new Date(tarea.fecha_inicio).toLocaleDateString()}</td>
                            <td class="cont">${new Date(tarea.fecha_final).toLocaleDateString()}</td>                            
                            <td class="cont">${tarea.descripcion}</td>
                            <td class="cont">${tarea.estado}</td>
                            <td class="cont">${tarea.porcentaje}</td>

                            <td>
                            <a href="/personal/${tarea.id}/editar" class="editar">Editar</a>
                            
                            <form action="{{ url('/personal/${tarea.id}/eliminar') }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');" class="eliminar">
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

    <!-- Ventana modal Crear Espacio -->
    <div id="crearEspacioModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-6 relative">
        <!-- Botón de cerrar -->
        <button
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
            onclick="cerrarModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Título -->
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Crear Espacio</h2>

        <!-- Formulario -->
        <form action="{{ route('espaciopersonal.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    maxlength="18"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Descripción -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input
                    type="text"
                    id="categoria"
                    name="categoria"
                    maxlength="25"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Botón Guardar -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script del modal -->
<script>
    function openModal() {
        const modal = document.getElementById('crearEspacioModal');
        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        const modal = document.getElementById('crearEspacioModal');
        modal.classList.add('hidden');
    }

    // Cerrar el modal al hacer clic fuera de él
    window.onclick = function(event) {
        const modal = document.getElementById('crearEspacioModal');
        if (event.target === modal) {
            cerrarModal();
        }
    };
</script>

</x-app-layout>
