<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-weight: bold;
            color: #283c86;
            margin-bottom: 25px;
            text-align: center;
        }
        .btn-custom {
            border-radius: 25px;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #1e2b5b;
            border-color: #1e2b5b;
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
        }
        .mt-3 {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .icon {
            font-size: 40px;
            color: #283c86;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Icono representativo -->
        <div class="text-center icon">
            <i class="fas fa-user-plus"></i>
        </div>

        <h1>Crear Usuario</h1>

        {{-- Mensajes de error --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required autocomplete="name">
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="form-group mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" id="rol" class="form-select" required>
                    <option value="basico" {{ old('rol') == 'basico' ? 'selected' : '' }}>Básico</option>
                    <option value="root" {{ old('rol') == 'root' ? 'selected' : '' }}>Root</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-custom">Guardar Usuario</button>
        </form>

        <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-custom mt-3 back-btn">Volver</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
