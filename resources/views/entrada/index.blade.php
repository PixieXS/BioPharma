<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Entradas</title>
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
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .btn-group {
            margin-bottom: 20px;
        }
        .btn-group a {
            margin-right: 10px;
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
            <h1 class="text-center">Lista De Entradas</h1>
        </div>

        <div class="btn-group d-flex justify-content-center mb-4">
            <a href="{{ route('entrada.create') }}" class="btn btn-success btn-custom">Registrar Entrada</a>
            <a href="/menuadmin" class="btn btn-secondary btn-custom">Volver al Menú Principal</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Medicamento</th>
                    <th>Cantidad</th>
                    <th>Costo Unitario</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
    @forelse ($entradas as $entrada)
        <tr>
            <td>{{ $entrada->id }}</td>
            <td>{{ $entrada->medicamento->nombre }}</td>
            <td>{{ $entrada->cantidad }}</td>
            <td>${{ number_format($entrada->costo_unitario, 2) }}</td>
            <td>{{ $entrada->fecha }}</td>
            <td>{{ $entrada->proveedor ?? 'N/A' }}</td>
            <td>
                <a class="btn btn-primary btn-custom" href="{{ route('entrada.edit', $entrada->id) }}">Editar</a>
            </td>
            <td>
                <form action="{{ route('entrada.confirmDelete', $entrada->id) }}" method="GET" style="display:inline-block;">
                    <button type="submit" class="btn btn-danger btn-custom">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">No hay entradas registradas.</td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
