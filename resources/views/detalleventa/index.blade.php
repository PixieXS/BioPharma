<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Detalles</title>
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
      <a class="navbar-brand mx-auto" href="#">Lista de Detalles</a>
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
      <a href="/venta" class="btn btn-secondary btn-custom">Volver al Menú Ventas</a>
    </div>

    <div class="table-container">
      <table class="table table-bordered table-striped">
        <thead>
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
