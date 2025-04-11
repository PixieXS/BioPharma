<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Devoluciones</title>
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
        .table-container {
            overflow-x: auto;
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
        <div class="page-header text-center">
            <h1>Lista de Devoluciones</h1>
        </div>

        <div class="btn-group d-flex justify-content-center mb-4">
            <a href="{{ route('devolucion.create') }}" class="btn btn-success btn-custom">Registrar Devolución</a>
            <a href="{{ auth()->user()->rol == 'root' ? route('menuadmin') : route('menubasico') }}" class="btn btn-secondary btn-custom">Volver al Menú Principal</a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-striped">
            <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>ID Venta</th>
        <th>Medicamento</th>
        <th>Usuario</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th>Motivo</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
</thead>
<tbody>
    @forelse ($devoluciones as $devolucion)
        <tr>
            <td>{{ $devolucion->id }}</td>
            <td>{{ $devolucion->detalleVenta->venta_id ?? 'N/A' }}</td>
            <td>{{ $devolucion->detalleVenta->medicamento->nombre ?? 'N/A' }}</td>
            <td>{{ $devolucion->usuario->nombre }}</td>
            <td>{{ $devolucion->cantidad }}</td>
            <td>{{ \Carbon\Carbon::parse($devolucion->fecha)->format('d/m/Y') }}</td>
            <td>{{ $devolucion->motivo }}</td>
            <td>
                <a class="btn btn-primary btn-custom" href="{{ route('devolucion.edit', $devolucion->id) }}">Editar</a>
            </td>
            <td>
                <form action="{{ route('devolucion.confirmDelete', $devolucion->id) }}" method="GET" style="display:inline-block;">
                    <button type="submit" class="btn btn-danger btn-custom">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">No hay devoluciones registradas.</td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
