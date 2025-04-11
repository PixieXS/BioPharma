<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Devolución</title>
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
            max-width: 600px;
        }
        h1 {
            font-weight: bold;
            color: #dc3545;
        }
        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        @media (min-width: 768px) {
            .btn-group-custom {
                flex-direction: row;
                justify-content: center;
            }
            .btn {
                width: 48%;
            }
        }
        .info-label {
            font-weight: bold;
            color: #343a40;
        }
        .info-value {
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container my-5 text-center">
        <h1 class="mb-4">¿Estás seguro de eliminar esta devolución?</h1>

        <div class="mb-3">
            <p><span class="info-label">ID:</span> <span class="info-value">{{ $devolucion->id }}</span></p>
            <p><span class="info-label">Medicamento:</span> <span class="info-value">{{ $devolucion->medicamento->nombre }}</span></p>
            <p><span class="info-label">Cantidad:</span> <span class="info-value">{{ $devolucion->cantidad }}</span></p>
            <p><span class="info-label">Fecha:</span> <span class="info-value">{{ $devolucion->fecha }}</span></p>
        </div>

        <form action="{{ route('devolucion.delete', $devolucion->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="btn-group-custom">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
