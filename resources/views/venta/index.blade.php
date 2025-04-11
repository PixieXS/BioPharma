<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Ventas</title>
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
    </style>
</head>
<body>

  <!-- Navbar con título centrado -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="#">Lista De Ventas</a>
    </div>
  </nav>

  <div class="container">
    {{-- Mensajes de éxito y error --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <div class="btn-group d-flex justify-content-center mb-4">
      <a href="{{ route('venta.create') }}" class="btn btn-success btn-custom">Registrar Venta</a>
      <a href="{{ auth()->user()->rol == 'root' ? route('menuadmin') : route('menubasico') }}" class="btn btn-secondary btn-custom">Volver al Menú Principal</a>
    </div>

    <div class="table-container">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Detalle</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($ventas as $venta)
            <tr>
              <td>{{ $venta->id }}</td>
              <td>{{ $venta->usuario->nombre ?? 'Sin nombre' }}</td>
              <td>L {{ number_format($venta->total, 2) }}</td>
              <td>
                @if ($venta->estado == 'pendiente')
                  <span class="badge bg-warning text-dark">{{ ucfirst($venta->estado) }}</span>
                @elseif ($venta->estado == 'completada')
                  <span class="badge bg-success">{{ ucfirst($venta->estado) }}</span>
                @else
                  <span class="badge bg-danger">{{ ucfirst($venta->estado) }}</span>
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
              <td>
                <a class="btn btn-info btn-custom" href="{{ url('detalleventa?ventaId=' . $venta->id) }}">Ver Detalles</a>
              </td>
              <td>
                <a class="btn btn-primary btn-custom" href="{{ route('venta.edit', $venta->id) }}">Editar</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No hay ventas registradas.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
