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
        <a class="flex justify-end w-full" href="{{ route('grupal.index') }}">
            <img src="{{ asset('images/close.png') }}" alt="Cerrar">
        </a>
        <div class="form-title">Agregar tarea</div>
        <form id="taskForm" class="player-form" action="{{ route('tareagrupal.store', ['id' => $id]) }}" method="POST">
            @csrf
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" maxlength="15" value="{{ old('nombre') }}" required>
        
            <label>Fecha de inicio</label>
            <input type="date" name="fechainicio" id="fechainicio" value="{{ old('fechainicio') }}" required>
        
            <label>Fecha final</label>
            <input type="date" name="fechafinal" id="fechafinal" value="{{ old('fechafinal') }}" required>
        
            <label>Descripción</label>
            <input type="text" name="descripcion" id="descripcion" maxlength="50" value="{{ old('descripcion') }}" required>
        
            <label>Estado</label>
            <select name="estado" id="estado" required>
                <option value="no iniciado" {{ old('estado') == 'no iniciado' ? 'selected' : '' }}>no iniciado</option>
                <option value="iniciado" {{ old('estado') == 'iniciado' ? 'selected' : '' }}>iniciado</option>
                <option value="casi por finalizar" {{ old('estado') == 'casi por finalizar' ? 'selected' : '' }}>casi por finalizar</option>
                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>finalizado</option>
            </select>
        
            <label>Porcentaje</label>
            <input name="porcentaje" id="range" type="range" min="0" max="100" step="1" value="{{ old('porcentaje', 0) }}">
            <p><span id="valor">{{ old('porcentaje', 0) }}</span></p>
        
            <label>Notas</label>
            <input type="text" name="categoria" id="categoria" maxlength="50" value="{{ old('categoria') }}">
        
            <label>Responsable</label>
            <select name="responsable" id="responsable" required>
                <option value="">Seleccione un responsable</option>
                @foreach ($miembros as $miembro)
                    <option value="{{ $miembro->usuario->name }}" {{ old('responsable') == $miembro->usuario->name ? 'selected' : '' }}>
                        {{ $miembro->usuario->name }}
                    </option>
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

</body>
</html>
