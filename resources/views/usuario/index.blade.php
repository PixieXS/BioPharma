<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Usuarios</title>
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
            <h1 class="text-center">Lista De Usuarios</h1>
        </div>

        {{-- Mensajes de éxito y error --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
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
            <thead class="table-dark">
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
