<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Editar Devolución</h1>
        <form action="{{ route('devolucion.update', $devolucion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="medicamento_id">Medicamento</label>
                <select id="medicamento_id" name="medicamento_id" class="form-control" required>
                    <option value="" disabled>Seleccione un medicamento</option>
                    @foreach($medicamentos as $medicamento)
                        <option value="{{ $medicamento->id }}" {{ $devolucion->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                            {{ $medicamento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Usuario (solo lectura o deshabilitado) -->
            <div class="mb-3">
                <label class="form-label" for="usuario_id">Usuario que realizó la Devolución:</label>
                <input type="text" id="usuario_id" class="form-control" value="{{ $devolucion->usuario->nombre }}" disabled>
                <input type="hidden" name="usuario_id" value="{{ $devolucion->usuario->id }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $devolucion->cantidad }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $devolucion->fecha }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="motivo">Motivo</label>
                <input type="text" id="motivo" name="motivo" class="form-control" value="{{ $devolucion->motivo }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
