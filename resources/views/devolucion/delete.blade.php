<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card p-4 text-center">
            <h1 class="text-danger">¿Eliminar esta devolución?</h1>
            <p class="mb-4">Esta acción no se puede deshacer.</p>

            <div class="mb-3 text-start">
                <p><strong>ID:</strong> {{ $devolucion->id }}</p>
                <p><strong>Medicamento:</strong> {{ $devolucion->medicamento->nombre }}</p>
                <p><strong>Cantidad:</strong> {{ $devolucion->cantidad }}</p>
                <p><strong>Fecha:</strong> {{ $devolucion->fecha }}</p>
            </div>

            <form action="{{ route('devolucion.delete', $devolucion->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
