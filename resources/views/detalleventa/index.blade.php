<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Detalles</title>
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
            <h1 class="text-center">Lista de Detalles</h1>
        </div>

        <div class="btn-group d-flex justify-content-center mb-4">
            <a href="/venta" class="btn btn-secondary btn-custom">Volver al Menú Ventas</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Codigo De Venta</th>
                    <th>Medicamento</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
    @php
        $totalGeneral = 0;
    @endphp

    @foreach ($detalles as $detalle)
    @php
        $totalGeneral += $detalle->subtotal;
    @endphp
    <tr>
        <td>{{ $detalle->id }}</td>
        <td>{{ $detalle->venta->id }}</td>
        <td>{{ $detalle->medicamento->nombre }}</td>
        <td>{{ $detalle->cantidad }}</td>
        <td>L {{ number_format($detalle->precio_unitario, 2) }}</td>
        <td>L {{ number_format($detalle->subtotal, 2) }}</td>
    </tr>
    @endforeach

    <!-- Fila del total -->
    @if ($detalles->count() > 1)
    <tr>
        <td colspan="5" class="text-end fw-bold">Total:</td>
        <td class="fw-bold text-success">L {{ number_format($totalGeneral, 2) }}</td>
    </tr>
    @endif
</tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
