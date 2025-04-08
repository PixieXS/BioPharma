<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Salida</title>
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
        <h1 class="text-center text-danger">Eliminar Salida</h1>
        <p class="text-center">¿Estás seguro de que deseas eliminar esta salida?</p>
        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Medicamento:</strong> {{ $salida->medicamento->nombre }}</li>
            <li class="list-group-item"><strong>Cantidad:</strong> {{ $salida->cantidad }}</li>
            <li class="list-group-item"><strong>Tipo de Salida:</strong> {{ ucfirst($salida->tipo_salida) }}</li>
            <li class="list-group-item"><strong>Fecha:</strong> {{ $salida->fecha }}</li>
        </ul>
        <form action="{{ route('salida.destroy', $salida->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-custom w-100">Eliminar</button>
        </form>
        <a href="{{ route('salida.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Cancelar</a>
    </div>
</body>
</html>
