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
        <a href="{{ route('espaciopersonal.index') }}">
            <img class="close" src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <form class="player-form" action="{{ route('task.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" required>

            <label>Fecha de inicio </label>
            <input type="date" name="fecha_inicio" value="{{old('fecha_incio',$tarea->fecha_inicio ? \Carbon\Carbon::parse($tarea->fecha_inicio)->format('Y-m-d') : '') }}">

            <label>Fecha final </label>
            <input type="date" name="fecha_final" value="{{old('fecha_final',$tarea->fecha_final ? \Carbon\Carbon::parse($tarea->fecha_final)->format('Y-m-d') : '') }}">

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ old('descripcion', $tarea->descripcion) }}" required>

            {{-- <label>Estado </label>
            <input type="text" name="estado" value="{{old('estado',$tarea->estado)}}" required> --}}
            <label>Estado </label>
            <select name="estado" required>
                <option value="no iniciado" {{$tarea->estado === 'no iniciado' ? 'selected' : ''}}>no iniciado</option>
                <option value="iniciado" {{$tarea->estado === 'iniciado' ? 'selected' : ''}}>iniciado</option>
                <option value="casi por finalizar" {{$tarea->estado === 'casi por finalizar' ? 'selected' : ''}}>casi por finalizar</option>
                <option value="finalizado" {{$tarea->estado === 'finalizado' ? 'selected' : ''}}>finalizado</option>
            </select>
            {{--aqui agregar tres campos iniciado,completado,finalizado--}}

            <label>Porcentaje </label>
            <input id="range" type="range" name="porcentaje" value="{{old('porcentaje',$tarea->porcentaje)}}" required>
            <p><span id="valor"></span></p>

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
