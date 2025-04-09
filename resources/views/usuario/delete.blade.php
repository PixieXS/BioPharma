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
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 80px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #dc3545;
        }
        .btn-custom {
            border-radius: 25px;
            width: 100%;
        }
        .btn-group-custom {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Eliminar Usuario</h1>

        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <div class="alert alert-warning text-center">
        <strong>¿Estás seguro?</strong><br>
        El usuario <strong>{{ $usuario->nombre }}</strong> será eliminado permanentemente.<br>
        <small>Esta acción no se puede deshacer.</small>
    </div>

    <div class="btn-group-custom">
        <button type="submit" class="btn btn-danger btn-custom">Sí, Eliminar</button>
        <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
    </div>
</form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
