<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Salida</title>
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
        <h1 class="text-center">Registrar Salida</h1>
        <form action="{{ route('salida.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" value="{{ Auth::user()->nombre }}" disabled>
                <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
            </div>

            <div class="mb-3">
                <label for="tipo_salida" class="form-label">Tipo de Salida</label>
                <select class="form-select" id="tipo_salida" name="tipo_salida" required>
                    <option value="venta">Venta</option>
                    <option value="ajuste">Ajuste</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $salida->fecha }}" required readOnly>
            </div>

            <button type="submit" class="btn btn-success btn-custom w-100">Registrar</button>
        </form>
        <a href="{{ route('salida.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
    </div>
</body>
</html>
