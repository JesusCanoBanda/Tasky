<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/agregartarea.css') }}">
    <title>Agregar Nueva Tarea</title>

</head>
<body>
    <div class="results-table">
        <div class="form-title">Agregar tarea</div>
        <a href="{{ route('grupal.index') }}">
            <img class="close" src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <form class="player-form" action="{{ route('tareagrupal.store', ['id' => "$id"]) }}" method="POST">
            @csrf
            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Fecha de inicio</label>
            <input type="date" name="fechainicio" required>

            <label>Fecha final</label>
            <input type="date" name="fechafinal" required>

            <label>Descripción</label>
            <input type="text" name="descripcion" required>

            <label>Estado</label>
            <input type="text" name="estado" required>

            <label>Porcentaje</label>
            <input type="number" name="porcentaje" required>

            <label>Categoría</label>
            <input type="text" name="categoria" required>

            <label>Responsable</label>
            <select name="responsable">
                <option value="">Seleccione un responsable</option>
                @foreach ($miembros as $miembro)
                    <option value="{{ $miembro->usuario->name }}">{{ $miembro->usuario->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="save-button">Guardar</button>
        </form>


    </div>
</body>
</html>
