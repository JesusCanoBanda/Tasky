<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Espacio</title>

</head>
<body>
    <div class="results-table">
        <div class="form-title">Crear espacio</div>
        <form class="player-form" action="{{ route('espaciopersonal.store') }}" method="POST">
            @csrf
            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Notas</label>
            <input type="text" name="categoria" required>

            <button type="submit" class="save-button">Guardar</button>
        </form>


        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>
</body>
</html>
