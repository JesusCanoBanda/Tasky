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
        <a href="{{ route('grupal.index') }}">
            <img class="close" src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <form class="player-form" action="{{ route('tareagrupal.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" required>
            <input type="date" id="fechainicio" name="fechainicio"
                value="{{ old('fechainicio', $tarea->fechainicio) }}">
            <input type="date" id="fechafinal" name="fechafinal" value="{{ old('fechafinal', $tarea->fechafinal) }}">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>

            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="iniciado" {{ old('estado', $tarea->estado) == 'iniciado' ? 'selected' : '' }}>Iniciado
                </option>
                <option value="completado" {{ old('estado', $tarea->estado) == 'completado' ? 'selected' : '' }}>
                    Completado</option>
                <option value="finalizado" {{ old('estado', $tarea->estado) == 'finalizado' ? 'selected' : '' }}>
                    Finalizado</option>
            </select>

            <label for="porcentaje">Porcentaje</label>
            <input type="number" id="porcentaje" name="porcentaje" value="{{ old('porcentaje', $tarea->porcentaje) }}"
                min="0" max="100" required>

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
</body>

</html>
