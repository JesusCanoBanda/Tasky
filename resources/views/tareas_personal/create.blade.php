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
        <a class="flex justify-end w-full" href="{{ route('espaciopersonal.index') }}">
            <img src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <form class="player-form" action="{{ route('task.store', ['id' => "$id"]) }}" method="POST">
            @csrf
        
            <label>Nombre</label>
            <input type="text" name="nombre" maxlength="15" required value="{{ old('nombre') }}">
        
            <label>Fecha de inicio</label>
            <input type="date" name="fecha_inicio" required value="{{ old('fecha_inicio') }}">
        
            <label>Fecha final</label>
            <input type="date" name="fecha_final" required value="{{ old('fecha_final') }}">
        
            <label>Descripción</label>
            <input type="text" name="descripcion" maxlength="30" required value="{{ old('descripcion') }}">
        
            <label>Estado</label>
            <select name="estado" required>
                <option value="no iniciado" {{ old('estado') == 'no iniciado' ? 'selected' : '' }}>no iniciado</option>
                <option value="iniciado" {{ old('estado') == 'iniciado' ? 'selected' : '' }}>iniciado</option>
                <option value="casi por finalizar" {{ old('estado') == 'casi por finalizar' ? 'selected' : '' }}>casi por finalizar</option>
                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>finalizado</option>
            </select>
        
            <label>Porcentaje</label>
            <input name="porcentaje" id="range" type="range" min="0" max="100" step="1" value="{{ old('porcentaje', 0) }}" required>
            <p><span id="valor"></span></p>
        
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
