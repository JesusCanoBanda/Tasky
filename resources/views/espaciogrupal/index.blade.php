<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="layout">
        <div class="sidebar">
            <h1 class="title">Espacios</h1>
            <hr>
            <a href="{{ route('grupal.miembros') }}" class="card-link">
                        <h4 class="name2"><b>gestionar miembros</b></h4>
            </a>
            @if ($espacios->isNotEmpty())
                @foreach ($espacios as $data)
                    @php
                        $espacio = $data['espacio'];
                        $isAdmin = $data['isAdmin'];
                    @endphp

                    <button class="space-name" onclick="loadEspacio({{ $espacio->id }})">{{ $espacio->nombre }}</button>

                    @if ($isAdmin)
                        <form action="{{ route('grupal.destroy', $espacio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="eliminar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este espacio?')">Eliminar</button>
                        </form>

                        <form action="{{ route('grupal.edit', $espacio->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="editar" style="margin-left: 10px;">Editar</button>
                        </form>
                    @endif
                @endforeach
            @else
                <p class="no-spaces">No tienes espacios creados aún.</p>
            @endif


            <hr>
            <button type="button" class="create-space" onclick="openModal()">+ Crear espacio</button>
            <button type="button" class="create-space" onclick="openJoinModal()">+ Unirse a espacio</button>
            {{--
            <!-- Nueva funcionalidad: Unirse a un espacio -->
            <form action="{{ route('grupal.join', ['id' => $espacio->id]) }}" method="POST" class="join-space-form">
                @csrf
                <label for="space-id" class="join-label">Unirse a un espacio</label>
                <input type="text" id="space-id" name="id_espacio" placeholder="ID del espacio" required>
                <button type="submit" class="join-button">Unirse</button>
            </form> --}}

        </div>

        <div class="main-content">
            <div id="espacio-content">
                <!-- Aquí se cargarán los datos del espacio seleccionado -->
                <p class="message">Selecciona un espacio para ver los detalles.</p>
            </div>

            <br>

            <div class="table">
                <table>

                    <thead id="tareas-header">
                        <!-- Dinámico -->
                    </thead>

                    <tbody id="tareas-list">
                        <!-- Dinámico -->
                    </tbody>

                </table>
            </div>

            {{-- <!-- Nueva funcionalidad: Invitar miembros -->
            <div id="invite-members" style="display: none;">
                <h2>Invitar miembros al espacio</h2>
                <form action="{{ route('grupal.invite') }}" method="POST">
                    @csrf
                    <label for="member-email">Correo del miembro:</label>
                    <input type="email" id="member-email" name="email" placeholder="Introduce el correo" required>
                    <input type="hidden" id="space-id-hidden" name="id_espacio">
                    <button type="submit" class="invite-button">Invitar</button>
                </form>
            </div> --}}
        </div>

    </div>
    <!-- Modal para ingresar el ID del espacio -->
    <div id="joinEspacioModal" class="ModalDialog">
        <div class="results-table">
            <div class="form-title">Unirse a un Espacio</div>
            <form id="joinEspacioForm" action="{{ route('grupal.join') }}" method="POST">
                @csrf
                <label for="id_espacio" class="name">ID del Espacio</label>
                <input class="input" type="number" id="id_espacio" name="id_espacio" required>
                <button type="submit" class="save-button">Unirse</button>
            </form>
            <div class="circle-wrapper">
                <div class="circle"></div>
            </div>
        </div>
    </div>

    <script>
        function openJoinModal() {
            document.getElementById('joinEspacioModal').style.display = 'flex';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('joinEspacioModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadEspacio(id) {
            $.ajax({
                url: `/grupal/${id}`,
                type: 'GET',
                success: function(response) {
                    const espacio = response.espacio;
                    const tareas = response.tareas;
                    const isAdmin = response.isAdmin; // Recibe el estado del rol

                    let taskButton = '';
                    if (isAdmin) {
                        taskButton =
                            `<a href="/tareagrupal/${espacio.id}/crear" class="task">Agregar Tarea</a>`;
                    }

                    $('#espacio-content').html(`
                <div class="card">
                    <h1 class="name">${espacio.nombre}</h1>
                    <p><span class="bold">Categoría: </span>${espacio.categoria}</p>
                    <p><span class="bold">Creado en: </span>${espacio.created_at}</p>
                    <p><span class="bold">Código de invitación: </span>${espacio.id}</p>
                </div>
                ${taskButton} <!-- Agregar el botón solo si es admin -->
            `);

                    $('#tareas-header').html(
                        `<tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha final</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Porcentaje</th>
                    <th>Categoria</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>`
                    );

                    let tareasHtml = '';
                    tareas.forEach((tarea) => {
                        let deleteButton = '';
                        if (isAdmin) {
                            deleteButton = `
                        <form action="/tareagrupal/${tarea.id}/eliminar" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');" class="eliminar">
                                Eliminar
                            </button>
                        </form>`;
                        }

                        tareasHtml += `
                    <tr>
                        <td class="cont">${tarea.id}</td>
                        <td class="cont">${tarea.nombre}</td>
                        <td class="cont">${tarea.fechainicio}</td>
                        <td class="cont">${tarea.fechafinal}</td>
                        <td class="cont">${tarea.descripcion}</td>
                        <td class="cont">${tarea.estado}</td>
                        <td class="cont">${tarea.porcentaje}</td>
                        <td class="cont">${tarea.categoria}</td>
                        <td class="cont">${tarea.responsable}</td>
                        <td>
                            <a href="/tareagrupal/${tarea.id}/editar" class="editar">Editar</a>
                            ${deleteButton} <!-- Mostrar el botón de eliminar solo si es admin -->
                        </td>
                    </tr>`;
                    });

                    $('#tareas-list').html(tareasHtml);

                    // Mostrar la funcionalidad para invitar miembros
                    $('#invite-members').show();
                    $('#space-id-hidden').val(espacio.id);
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos:', xhr);
                    alert('No se pudo cargar el espacio o las tareas. Inténtalo de nuevo.');
                }
            });
        }
    </script>

    <!-- Ventana modal Crear Espacio -->

    <div id="crearEspacioModal" class="ModalDialog">
        <div class="results-table">
            <div class="form-title">Crear espacio</div>
            <form class="player-form" action="{{ route('grupal.store') }}" method="POST">
                @csrf
                <label class="name">Nombre</label>
                <input class="input" type="text" name="nombre" required>
                <br>
                <label class="category">Descripción</label>
                <input class="input2" type="text" name="categoria" required>
                <br>
                <button type="submit" class="save-button">Guardar</button>
            </form>

            <div class="circle-wrapper">
                <div class="circle"></div>
            </div>
        </div>
    </div>

    <!-- Script del modal Crear Espacio -->

    <script>
        function openModal() {
            document.getElementById('crearEspacioModal').style.display = 'flex';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('crearEspacioModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
