<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5 text-center">
        <h1>¿Estás seguro de que deseas eliminar esta devolución?</h1>
        <p><strong>ID:</strong> {{ $devolucion->id }}</p>
        <p><strong>Medicamento:</strong> {{ $devolucion->medicamento->nombre }}</p>
        <p><strong>Cantidad:</strong> {{ $devolucion->cantidad }}</p>
        <p><strong>Fecha:</strong> {{ $devolucion->fecha }}</p>
        <form action="{{ route('devolucion.delete', $devolucion->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
    </div>
</body>
</html>