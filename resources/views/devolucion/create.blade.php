<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
        window.onload = function() {
            const fechaInput = document.querySelector('input[name="fecha"]');
            const today = new Date();
            const year = today.getFullYear();
            const month = ('0' + (today.getMonth() + 1)).slice(-2); 
            const day = ('0' + today.getDate()).slice(-2);
            const currentDate = `${year}-${month}-${day}`;
            fechaInput.value = currentDate; 
        };
    </script>
<body>
    <div class="container my-5">
        <h1 class="text-center">Registrar Devolución</h1>
        <div class="card p-4">
            <form action="{{ route('devolucion.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="detalle_venta_id" class="form-label">Detalle de Venta (Venta ID - Medicamento)</label>
                    <select name="detalle_venta_id" id="detalle_venta_id" class="form-select" required>
                        <option value="">Seleccione un detalle de venta</option>
                        @foreach ($detalleVentas as $detalle)
                            <option value="{{ $detalle->id }}">
                                Venta #{{ $detalle->venta_id }} - {{ $detalle->medicamento->nombre }} (Comprado: {{ $detalle->cantidad }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario</label>
                    <input type="text" id="usuario_id" class="form-control" value="{{ Auth::user()->nombre }}" disabled>
                    <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad a Devolver</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required readOnly>
                </div>

                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" maxlength="255" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
