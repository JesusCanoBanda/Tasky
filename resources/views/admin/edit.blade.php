<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-cancel {
            background-color: #f44336;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }
        .btn-cancel:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="{{ route('admin.update', $users->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ old('name', $users->name) }}" maxlength="20" required>

        <label for="user_name">Usuario</label>
        <input type="text" name="user_name" id="user_name" value="{{ old('user_name', $users->user_name) }}" maxlength="15" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $users->apellidos) }}" maxlength="15" required>

        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="0" {{ old('rol', $users->rol) == 0 ? 'selected' : '' }}>Usuario</option>
            <option value="1" {{ old('rol', $users->rol) == 1 ? 'selected' : '' }}>Administrador</option>
        </select>

        <button type="submit">Guardar Cambios</button>
        <a href="{{ route('admin.index') }}" class="btn-cancel">Cancelar</a>
    </form>
</body>
</html>
