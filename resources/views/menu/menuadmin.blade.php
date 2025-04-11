<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo - Farmacia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
    }
    .sidebar {
      height: 100vh;
      background-color: #1e2a38;
      padding-top: 20px;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 15px 20px;
      display: block;
      transition: background-color 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #0d6efd;
    }
    .content {
      margin-left: 220px;
      padding: 20px;
    }
    .topbar {
      background-color: #0d6efd;
      color: white;
      padding: 10px 20px;
      font-size: 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>

  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar position-fixed w-100" style="max-width: 220px;">
      <h4 class="text-center">💊 BIOPHARMA</h4>
      <a href="{{ route('menuadmin') }}"><i class="fas fa-home me-2"></i>Inicio</a>
      <a href="{{ route('medicamento.index') }}"><i class="fas fa-pills me-2"></i>Medicamentos</a>
      <a href="{{ route('entrada.index') }}"><i class="fas fa-arrow-circle-down me-2"></i>Entradas</a>
      <a href="{{ route('salida.index') }}"><i class="fas fa-arrow-circle-up me-2"></i>Salidas</a>
      <a href="{{ route('venta.index') }}"><i class="fas fa-shopping-cart me-2"></i>Ventas</a>
      <a href="{{ route('devolucion.index') }}"><i class="fas fa-undo me-2"></i>Devoluciones</a>
      <a href="{{ route('usuario.index') }}"><i class="fas fa-users-cog me-2"></i>Usuarios</a>
    </div>

    <!-- Contenido -->
    <div class="content w-100">
      <div class="topbar">
        <span>Bienvenido, {{ $usuario->nombre ?? 'Admin' }}</span>
        <a href="{{ route('logout') }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
      </div>

      {{-- Aquí se cargan las vistas específicas --}}
      @yield('contenido')
      @extends('layouts.admin')

@section('contenido')
    <div class="container my-5">
        <div class="page-header">
            <h1 class="text-center">Lista De Ventas</h1>
        </div>
        
        <div class="btn-group d-flex justify-content-center mb-4">
            <a href="{{ route('venta.create') }}" class="btn btn-success btn-custom">Registrar Venta</a>
            <a href="{{ auth()->user()->rol == 'root' ? route('menuadmin') : route('menubasico') }}" class="btn btn-secondary btn-custom">Volver al Menú Principal</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
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
                            <a class="btn btn-info btn-sm" href="{{ url('detalleventa?ventaId=' . $venta->id) }}">
                                Ver Detalles
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm btn-custom" href="{{ route('venta.edit', $venta->id) }}">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que deseas eliminar esta venta? Esta acción no se puede deshacer.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ventaId = button.getAttribute('data-id');
            var form = confirmModal.querySelector('#deleteForm');
            form.action = `/venta/${ventaId}`;
        });
    </script>
@endsection

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
