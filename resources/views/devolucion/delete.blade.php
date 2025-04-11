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
        <div class="card p-4 text-center border-danger">
            <h1 class="text-danger mb-3">¿Eliminar esta devolución?</h1>
            <p class="mb-4 text-muted">Esta acción no se puede deshacer. Asegúrate de que realmente deseas eliminar esta devolución registrada.</p>

            <div class="mb-4 text-start">
                <p><strong>ID de la devolución:</strong> {{ $devolucion->id }}</p>
                <p><strong>Medicamento:</strong> {{ $devolucion->medicamento->nombre }}</p>
                <p><strong>Cantidad devuelta:</strong> {{ $devolucion->cantidad }}</p>
                <p><strong>Fecha de devolución:</strong> {{ $devolucion->fecha }}</p>
                <p><strong>Motivo:</strong> {{ $devolucion->motivo }}</p>
                @if($devolucion->usuario)
                    <p><strong>Registrado por:</strong> {{ $devolucion->usuario->nombre }}</p>
                @endif
            </div>

            <form action="{{ route('devolucion.delete', $devolucion->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-danger px-4">Eliminar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
