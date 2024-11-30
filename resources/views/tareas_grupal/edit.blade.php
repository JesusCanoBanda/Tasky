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
            <input type="date" name="fecha_inicio" value="{{old('fecha_incio',$tarea->fecha_inicio)}}" required>

            <label>Fecha final </label>
            <input type="date" name="fecha_final" value="{{old('fecha_final',$tarea->fecha_final)}}" required>

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ old('descripcion', $tarea->descripcion) }}" required>

            <label>Estado </label>
            <input type="text" name="estado" value="{{old('estado',$tarea->estado)}}" required>
            {{--aqui agregar tres campos iniciado,completado,finalizado--}}

            <label>Porcentaje </label>
            <input type="number" name="porcentaje" value="{{old('porcentaje',$tarea->porcentaje)}}" required>
            

            <button type="submit" class="save-button">Actualizar</button>
        </form>

        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>
</body>
</html>
