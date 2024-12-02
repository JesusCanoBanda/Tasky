<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editartareas.css') }}">
    <title>Editar Espacio</title>
</head>

<body>
    <div class="results-table">
        <div class="form-title">Editar tarea</div>
        <a class="flex justify-end w-full" href="{{ route('grupal.index') }}">
            <img src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <form class="player-form" action="{{ route('tareagrupal.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" required>

            <label>Fecha de inicio</label>
            <input type="date" id="fechainicio" name="fechainicio" value="{{ old('fechainicio', $tarea->fechainicio ? \Carbon\Carbon::parse($tarea->fechainicio)->format('Y-m-d') : '') }}">

            <label>Fecha de inicio</label>
            <input type="date" id="fechafinal" name="fechafinal" value="{{ old('fechafinal', $tarea->fechafinal ? \Carbon\Carbon::parse($tarea->fechafinal)->format('Y-m-d') : '') }}">

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ old('descripcion', $tarea->descripcion) }}" required>

            <label>Estado </label>
            <select name="estado" required>
                <option value="no iniciado" {{$tarea->estado === 'no iniciado' ? 'selected' : ''}}>no iniciado</option>
                <option value="iniciado" {{$tarea->estado === 'iniciado' ? 'selected' : ''}}>iniciado</option>
                <option value="casi por finalizar" {{$tarea->estado === 'casi por finalizar' ? 'selected' : ''}}>casi por finalizar</option>
                <option value="finalizado" {{$tarea->estado === 'finalizado' ? 'selected' : ''}}>finalizado</option>
            </select>

            <label>Porcentaje </label>
            <input id="range" type="range" name="porcentaje" value="{{old('porcentaje',$tarea->porcentaje)}}" required>
            <p><span id="valor"></span></p>

            <label>Responsable</label>
            <select name="responsable">
                <option value="">Seleccione un responsable</option>
                @foreach ($miembros as $miembro)
                    <option value="{{ $miembro->usuario->name }}"
                        {{ old('responsable', $tarea->responsable) == $miembro->usuario->name ? 'selected' : '' }}>
                        {{ $miembro->usuario->name }}
                    </option>
                @endforeach
            </select>

            <label for="categoria">Categoría</label>
            <input type="text" id="categoria" name="categoria" value="{{ old('categoria', $tarea->categoria) }}"
                required>

            <button type="submit" class="save-button">Actualizar</button>
        </form>


        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>

    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Entendido'
                });
            };
        </script>
    @endif

    <script>
        const range = document.getElementById('range');
        const valorRange = document.getElementById('valor');

        valorRange.textContent = range.value;

        range.addEventListener('input',()=>{
            valorRange.textContent = range.value;
        });
    </script>
</body>

</html>
