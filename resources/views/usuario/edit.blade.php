<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        h1 { font-weight: bold; color: #333; }
        .btn-custom { border-radius: 25px; }
        .container { max-width: 600px; margin: 0 auto; }
    </style>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-4">Editar Usuario</h1>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('usuario.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco para mantener la actual)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nueva contraseña (opcional)">
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" id="rol" name="rol" required
                @if ($user->id == auth()->id()) disabled @endif>
                <option value="basico" {{ $user->rol == 'basico' ? 'selected' : '' }}>Básico</option>
                <option value="root" {{ $user->rol == 'root' ? 'selected' : '' }}>Root</option>
            </select>
            @if ($user->id == auth()->id())
                <input type="hidden" name="rol" value="{{ $user->rol }}">
                <small class="text-muted">No puedes cambiar tu propio rol.</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required
                @if ($user->id == auth()->id()) disabled @endif>
                <option value="activo" {{ $user->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $user->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @if ($user->id == auth()->id())
                <input type="hidden" name="estado" value="{{ $user->estado }}">
                <small class="text-muted">No puedes desactivar tu propio usuario.</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-custom w-100">Actualizar Usuario</button>
    </form>

    <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
