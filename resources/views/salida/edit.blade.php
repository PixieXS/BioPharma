<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Salida</title>
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
        <h1 class="text-center">Editar Salida</h1>
        <form action="{{ route('salida.update', $salida->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="medicamento_id" class="form-label">Medicamento</label>
                <select class="form-select" id="medicamento_id" name="medicamento_id" required readOnly>
                    @foreach ($medicamentos as $medicamento)
                        <option value="{{ $medicamento->id }}" {{ $medicamento->id == $salida->medicamento_id ? 'selected' : '' }}>
                            {{ $medicamento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="usuario_id" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario_id" value="{{ $salida->usuario->nombre }}" readonly>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="{{ $salida->cantidad }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo_salida" class="form-label">Tipo de Salida</label>
                <select class="form-select" id="tipo_salida" name="tipo_salida" required>
                    <option value="venta" {{ $salida->tipo_salida == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="ajuste" {{ $salida->tipo_salida == 'ajuste' ? 'selected' : '' }}>Ajuste</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $salida->fecha }}" required readOnly>
            </div>
            <button type="submit" class="btn btn-primary btn-custom w-100">Actualizar</button>
        </form>
        <a href="{{ route('salida.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
    </div>
</body>
</html>
