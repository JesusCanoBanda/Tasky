<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
</head>
<body>
    <div class="results-table">
        <div class="form-title">Editar Espacio</div>
        <form class="player-form" action="{{ route('espaciopersonal.update', $espacio->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Cambiar a PUT para realizar la actualización -->

            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $espacio->nombre) }}" required>

            <label>Categoria</label>
            <input type="text" name="categoria" value="{{ old('categoria', $espacio->categoria) }}" required>

            <button type="submit" class="save-button">Actualizar</button>
        </form>

        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>
</body>
</html>
