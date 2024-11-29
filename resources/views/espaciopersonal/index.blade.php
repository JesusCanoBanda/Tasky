<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="layout">
        <div class="sidebar">
            <h1 class="title">Espacios</h1>
            <hr>
            @if ($espacios->isNotEmpty())
                @foreach ($espacios as $espacio)

                    <button class="space-name" onclick="loadEspacio({{ $espacio->id }})">{{ $espacio->nombre }}</button>

                    <form action="{{ route('espaciopersonal.destroy', $espacio->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="eliminar"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este espacio?')">Eliminar</button>
                    </form>

                    <form action="{{ route('espaciopersonal.edit', $espacio->id) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit" class="editar" style="margin-left: 10px;">Editar</button>
                    </form>
                    
                @endforeach
            @else
                <p class="no-spaces">No tienes espacios creados aún.</p>
            @endif
            <hr>
            <button type="button" class="create-space" onclick="openModal()">+ Crear espacio</button>
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
                    <p><span class="bold">Creado en: </span>${espacio.created_at}</p>
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
                            <td class="cont">${tarea.fecha_inicio}</td>
                            <td class="cont">${tarea.fecha_final}</td>
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

    <div id="crearEspacioModal" class="ModalDialog">
        <div class="results-table">
            <div class="form-title">Crear espacio</div>
            <form class="player-form" action="{{ route('espaciopersonal.store') }}" method="POST">
                @csrf
                <label class="name">Nombre</label>
                <input class="input" type="text" name="nombre" required>
                <br>
                <label class="category">Categoria</label>
                <input class="input2" type="text" name="categoria" required>
                <br>
                <button type="submit" class="save-button">Guardar</button>
            </form>
    
    
            <div class="circle-wrapper">
                <div class="circle"></div>
            </div>
        </div>
    </div>

    <!-- Script del modal  crear espacio -->

    <script>

        function openModal(){
            document.getElementById('crearEspacioModal').style.display = 'flex';
        }

        //Esto hace que se cierre clickeando afuera del modal
        window.onclick = function(event){
            var modal = document.getElementById('crearEspacioModal');
            if(event.target == modal){
                modal.style.display = 'none';
            }
        }

    </script>    
</x-app-layout>
