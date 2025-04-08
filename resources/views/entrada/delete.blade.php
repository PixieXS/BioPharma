<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Entrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center text-danger">Eliminar Entrada</h1>
        <div class="card p-4 text-center">
            <p class="fs-5">¿Estás seguro de que deseas eliminar esta entrada?</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Medicamento:</strong> {{ $entrada->medicamento->nombre }}</li>
                <li class="list-group-item"><strong>Cantidad:</strong> {{ $entrada->cantidad }}</li>
                <li class="list-group-item"><strong>Costo Unitario:</strong> {{ $entrada->costo_unitario }}</li>
                <li class="list-group-item"><strong>Fecha:</strong> {{ $entrada->fecha }}</li>
                <li class="list-group-item"><strong>Proveedor:</strong> {{ $entrada->proveedor }}</li>
            </ul>
            <form action="{{ route('entrada.destroy', $entrada->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="{{ route('entrada.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
