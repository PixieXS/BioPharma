<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .btn-custom {
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center mb-4">Eliminar Usuario</h1>

        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="alert alert-warning">
                <strong>Advertencia:</strong> ¿Estás seguro de que deseas eliminar el usuario <strong>{{ $usuario->nombre }}</strong>?
                Esta acción no se puede deshacer.
            </div>

            <button type="submit" class="btn btn-danger btn-custom">Eliminar Usuario</button>
            <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
