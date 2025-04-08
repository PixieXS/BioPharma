<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .btn-custom {
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center mb-4">Editar Medicamento</h1>

        <form action="{{ route('medicamento.update', $medicamento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre', $medicamento->nombre) }}">
                </div>
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $medicamento->descripcion) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" required value="{{ old('stock', $medicamento->stock) }}">
                </div>
                <div class="col-md-6">
                    <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                    <select name="unidad_medida" id="unidad_medida" class="form-control" required>
                        <option value="mg" {{ old('unidad_medida', $medicamento->unidad_medida) == 'mg' ? 'selected' : '' }}>mg</option>
                        <option value="ml" {{ old('unidad_medida', $medicamento->unidad_medida) == 'ml' ? 'selected' : '' }}>ml</option>
                        <option value="tableta" {{ old('unidad_medida', $medicamento->unidad_medida) == 'tableta' ? 'selected' : '' }}>Tableta</option>
                        <option value="caja" {{ old('unidad_medida', $medicamento->unidad_medida) == 'caja' ? 'selected' : '' }}>Caja</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control" required value="{{ old('precio', $medicamento->precio) }}">
                </div>
                <div class="col-md-6">
                    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" required value="{{ old('fecha_vencimiento', $medicamento->fecha_vencimiento) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="alerta_vencimiento" class="form-label">Alerta de Vencimiento</label>
                    <select name="alerta_vencimiento" id="alerta_vencimiento" class="form-control">
                        <option value="1" {{ old('alerta_vencimiento', $medicamento->alerta_vencimiento) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('alerta_vencimiento', $medicamento->alerta_vencimiento) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-custom">Actualizar Medicamento</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
