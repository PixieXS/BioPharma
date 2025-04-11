<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Ventas</title>
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
        .alert-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            margin-top: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            display: none;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
