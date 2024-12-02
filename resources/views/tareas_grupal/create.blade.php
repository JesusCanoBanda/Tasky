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
            <input type="text" name="nombre" >

            <label>Fecha de inicio</label>
            <input type="date" name="fechainicio" >

            <label>Fecha final</label>
            <input type="date" name="fechafinal" >

            <label>Descripción</label>
            <input type="text" name="descripcion" >

            <label>Estado </label>
            <select name="estado" >
                <option value="no iniciado">no iniciado</option>
                <option value="iniciado">iniciado</option>
                <option value="casi por finalizar">casi por finalizar</option>
                <option value="finalizado">finalizado</option>
            </select>

            <label>Porcentaje </label>
            <input name="porcentaje" id="range" type="range" min="0" max="100" step="1" value="0" >
            <p><span id="valor"></span></p>

            <label>Categoría</label>
            <input type="text" name="categoria" >

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

    <script>//pa mostrar el valor del range, si le quieren mover ta bien namas asegurense que me retorne un string
        const range = document.getElementById('range');
        const valorRange = document.getElementById('valor');

        valorRange.textContent = range.value;

        range.addEventListener('input',()=>{
            valorRange.textContent = range.value;
        });
    </script>
</body>
</html>
