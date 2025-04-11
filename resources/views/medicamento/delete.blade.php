<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-custom {
            border-radius: 25px;
            width: 100%;
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .mt-3 {
            margin-top: 15px;
        }
        small {
            color: #888;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h1>Eliminar Medicamento</h1>

    {{-- Mensajes de advertencia --}}
    <div class="alert alert-warning">
        <strong>Advertencia:</strong> ¿Estás seguro de que deseas eliminar el medicamento <strong>{{ $medicamento->nombre }}</strong>?
        Esta acción no se puede deshacer.
    </div>

    <form action="{{ route('medicamento.destroy', $medicamento->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger btn-custom">Eliminar Medicamento</button>
    </form>

    <a href="{{ route('medicamento.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
