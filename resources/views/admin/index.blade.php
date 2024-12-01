<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #4CAF50;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->apellidos }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol == 1 ? 'Administrador' : 'Usuario' }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-edit">Editar</a>
                        <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-edit">Regresar</a>
</body>
</html>
