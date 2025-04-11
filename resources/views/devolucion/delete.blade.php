<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1 {
            font-weight: bold;
            color: #dc3545;
        }
        .btn-custom {
            border-radius: 25px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="card p-4">
            <div class="text-center mb-4">
                <h1>¿Deseas eliminar esta devolución?</h1>
                <p class="text-muted">Esta acción no se puede deshacer.</p>
            </div>

            <div class="mb-3">
                <p><span class="info-label">ID:</span> {{ $devolucion->id }}</p>
                <p><span class="info-label">Medicamento:</span> {{ $devolucion->detalleVenta->medicamento->nombre ?? 'No disponible' }}</p>
                <p><span class="info-label">Usuario:</span> {{ $devolucion->usuario->nombre ?? 'No disponible' }}</p>
                <p><span class="info-label">Cantidad:</span> {{ $devolucion->cantidad }}</p>
                <p><span class="info-label">Fecha:</span> {{ \Carbon\Carbon::parse($devolucion->fecha)->format('d/m/Y') }}</p>
                <p><span class="info-label">Motivo:</span> {{ $devolucion->motivo }}</p>
            </div>

            <form action="{{ route('devolucion.delete', $devolucion->id) }}" method="POST" class="text-center">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-danger btn-custom">Eliminar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
