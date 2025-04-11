<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista De Usuarios</title>
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
      <a class="navbar-brand mx-auto" href="#">Lista de Usuarios</a>
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
      <a href="{{ route('usuario.create') }}" class="btn btn-success btn-custom">Crear Usuario</a>
      <a href="/menuadmin" class="btn btn-secondary btn-custom">Volver al Menú Principal</a>
    </div>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Estado</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->nombre }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ ucfirst($u->rol) }}</td>
            <td>{{ ucfirst($u->estado) }}</td>
            <td>
              <a href="{{ route('usuario.edit', $u->id) }}" class="btn btn-primary btn-custom">Editar</a>
            </td>
            <td>
              @php
                $esRootActivo = $u->rol === 'root' && $u->estado === 'activo';
                $hayOtroRootActivo = \App\Models\Usuario::where('rol', 'root')
                                                    ->where('estado', 'activo')
                                                    ->where('id', '!=', $u->id)
                                                    ->exists();
              @endphp

              @if ($u->id == auth()->id())
                <button class="btn btn-secondary btn-custom" disabled>No disponible</button>
              @elseif ($esRootActivo && !$hayOtroRootActivo)
                <button class="btn btn-secondary btn-custom" disabled>Último Root</button>
              @else
                <a href="{{ route('usuario.confirmDelete', $u->id) }}" class="btn btn-danger btn-custom">Eliminar</a>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
