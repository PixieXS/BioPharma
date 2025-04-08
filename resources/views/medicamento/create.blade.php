<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Medicamento</title>
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
        <h1 class="text-center">Registrar Medicamento</h1>
        <form action="{{ route('medicamento.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>
            </div>
            <div class="mb-3">
                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                <select class="form-select" id="unidad_medida" name="unidad_medida" required>
                    <option value="mg" {{ old('unidad_medida') == 'mg' ? 'selected' : '' }}>mg</option>
                    <option value="ml" {{ old('unidad_medida') == 'ml' ? 'selected' : '' }}>ml</option>
                    <option value="tableta" {{ old('unidad_medida') == 'tableta' ? 'selected' : '' }}>Tableta</option>
                    <option value="caja" {{ old('unidad_medida') == 'caja' ? 'selected' : '' }}>Caja</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
            </div>
            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" required>
            </div>
            <div class="mb-3">
                <label for="alerta_vencimiento" class="form-label">Alerta de Vencimiento</label>
                <input type="checkbox" class="form-check-input" id="alerta_vencimiento" name="alerta_vencimiento" {{ old('alerta_vencimiento') ? 'checked' : '' }}>
                <label class="form-check-label" for="alerta_vencimiento">Activar alerta</label>
            </div>
            <button type="submit" class="btn btn-success btn-custom w-100">Registrar Medicamento</button>
        </form>
        <a href="{{ route('medicamento.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
    </div>
</body>
</html>
