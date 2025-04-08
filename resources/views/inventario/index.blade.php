<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Medicamentos</title>
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
            padding: 10px 20px;
            font-size: 14px;
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
        .search-bar {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-bar form {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .search-bar input, .search-bar select, .search-bar button {
            margin-right: 10px;
        }
        .search-bar button {
            margin-top: 0;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="page-header">
            <h1 class="text-center">Lista De Medicamentos</h1>
        </div>

        <div class="search-bar">
            <div class="d-flex">
                <form action="{{ route('medicamento.search') }}" method="GET" class="d-flex">
                    <select class="form-control" name="tipo_busqueda">
                        <option value="nombre">Por Nombre</option>
                        <option value="descripcion">Por Descripción</option>
                    </select>
                    <input type="text" class="form-control" name="query" placeholder="Buscar..." required>
                    <button class="btn btn-primary btn-custom" type="submit">Buscar</button>
                </form>
    
                <a href="{{ route('menubasico') }}" class="btn btn-secondary btn-custom ml-3">Volver al Menú</a>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Unidad de Medida</th>
                    <th>Precio</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Alerta Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicamentos as $medicamento)
                    <tr>
                        <td>{{ $medicamento->id }}</td>
                        <td>{{ $medicamento->nombre }}</td>
                        <td>{{ $medicamento->descripcion }}</td>
                        <td>{{ $medicamento->stock }}</td>
                        <td>{{ $medicamento->unidad_medida }}</td>
                        <td>{{ $medicamento->precio }}</td>
                        <td>{{ $medicamento->fecha_vencimiento }}</td>
                        <td>{{ $medicamento->alerta_vencimiento ? 'Sí' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No se encontraron medicamentos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
