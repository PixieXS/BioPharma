<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1 {
            font-weight: bold;
            color: #333;
        }
        .btn-custom {
            border-radius: 25px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .page-header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="page-header">
        <h1 class="text-center">Eliminar Venta</h1>
    </div>

    <form method="POST" action="{{ route('venta.destroy', $venta->id) }}">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Cliente:</label>
            <input type="text" class="form-control" value="{{ $venta->usuario->nombre }}" readonly>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="text" class="form-control" value="{{ $venta->fecha }}" readonly>
        </div>

        <h5>Medicamentos</h5>
        <div id="medicamentos-container">
            @foreach ($venta->medicamentos as $medicamento)
                <div class="row mb-3 medicamento-item">
                    <div class="col-md-5">
                        <label for="medicamento_id" class="form-label">Medicamento:</label>
                        <input type="text" class="form-control" value="{{ $medicamento->nombre }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="text" class="form-control" value="{{ $medicamento->pivot->cantidad }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="precio_unitario" class="form-label">Precio:</label>
                        <input type="text" class="form-control" value="{{ $medicamento->precio }}" readonly>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="text-danger">¿Estás seguro de que deseas eliminar esta venta?</p>
        <button type="submit" class="btn btn-danger btn-custom">Eliminar Venta</button>
        <a href="{{ route('venta.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
