<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
</head>
<body>
    <div class="results-table">
        <div class="form-title">Editar tare</div>
        <form class="player-form" action="{{ route('task.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $tarea->nombre) }}" required>

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ old('descripcion', $tarea->descripcion) }}" required>


            <button type="submit" class="save-button">Actualizar</button>
        </form>

        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>
</body>
</html>
