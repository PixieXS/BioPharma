<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7f8;
            margin: 0;
            height: 100vh;
        }
        .navbar {
            background-color: #283c86;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        h1 {
            font-size: 32px;
            color: #333;
            text-align: center;
            margin: 30px 0;
        }
        .container {
            margin-top: 30px;
            max-width: 1200px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }
        .btn-custom {
            border-radius: 25px;
        }
        .btn-group {
            margin-bottom: 20px;
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
        .table th {
            background-color: #283c86;
            color: white;
        }
        .alert {
            text-align: center;
        }
        .btn-group a {
            margin-right: 10px;
        }
        .page-header {
            margin-bottom: 30px;
        }

        .alerta-vencidos {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .alerta-vencidos strong {
            font-weight: bold;
        }

        .table tr.alerta {
            background-color: #f8d7da;
        }

        .table tr.alerta td {
            color: #721c24;
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

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="#">Lista de Medicamentos</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="search-bar">
            <div class="d-flex">
                <form action="{{ route('medicamento.searchInventario') }}" method="GET" class="d-flex">
                    <select class="form-control" name="tipo_busqueda">
                        <option value="nombre">Nombre o Descripción</option>
                    </select>
                    <input type="text" class="form-control" name="query" placeholder="Buscar..." required>
                    <button class="btn btn-primary btn-custom" type="submit">Buscar</button>
                </form>

                <a href="{{ route('medicamento.resetInventario') }}" class="btn btn-secondary btn-custom ml-3">Ver Todos los Medicamentos</a>
            </div>

            <a href="{{ route('menubasico') }}" class="btn btn-secondary btn-custom ml-3">Volver al Menú Principal</a>
        </div>

        @if(session('alertaVencidos'))
            <div class="alerta-vencidos">
                <strong>Alerta:</strong> Algunos medicamentos están vencidos. Por favor, revisa los medicamentos de la lista.
            </div>
        @endif

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
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
                        <tr class="{{ $medicamento->alerta_vencimiento ? 'alerta' : '' }}">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
