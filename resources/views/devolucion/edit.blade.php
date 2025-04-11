<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Editar Devolución</h1>
        <div class="card p-4">
            <form action="{{ route('devolucion.update', $devolucion->id) }}" method="POST" id="formDevolucion">
                @csrf
                @method('PUT')

                {{-- Detalle de venta --}}
                <div class="mb-3">
                    <label for="detalle_venta_id" class="form-label">Detalle de Venta (Venta ID - Medicamento)</label>
                    <select name="detalle_venta_id" id="detalle_venta_id" class="form-select" required readOnly>
                        <option value="">Seleccione un detalle de venta</option>
                        @foreach ($detalleVentas as $detalle)
                            <option 
                                value="{{ $detalle->id }}" 
                                data-cantidad="{{ $detalle->cantidad }}" 
                                data-devuelto="{{ $detalle->devoluciones_sum() }}" 
                                {{ old('detalle_venta_id', $devolucion->detalle_venta_id) == $detalle->id ? 'selected' : '' }}>
                                Venta #{{ $detalle->venta_id }} - {{ $detalle->medicamento->nombre }} (Comprado: {{ $detalle->cantidad }})
                            </option>
                        @endforeach
                    </select>
                    @error('detalle_venta_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="infoDevolucion" class="form-text text-muted mt-2"></small>
                </div>

                {{-- Usuario --}}
                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario</label>
                    <input type="text" id="usuario_id" class="form-control" value="{{ $devolucion->usuario->nombre }}" disabled>
                    <input type="hidden" name="usuario_id" value="{{ $devolucion->usuario->id }}">
                </div>

                {{-- Cantidad --}}
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad a Devolver</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="{{ old('cantidad', $devolucion->cantidad) }}" required>
                    @error('cantidad')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="errorCantidad" class="text-danger d-none">No puede devolver más de lo permitido.</small>
                </div>

                {{-- Fecha --}}
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $devolucion->fecha) }}" required readonly>
                </div>

                {{-- Motivo --}}
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" maxlength="255" value="{{ old('motivo', $devolucion->motivo) }}" required>
                    @error('motivo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    window.onload = function() {
        const fechaInput = document.querySelector('input[name="fecha"]');
        const today = new Date();
        const year = today.getFullYear();
        const month = ('0' + (today.getMonth() + 1)).slice(-2);
        const day = ('0' + today.getDate()).slice(-2);
        fechaInput.value = `${year}-${month}-${day}`;

        const selectDetalle = document.getElementById('detalle_venta_id');
        const cantidadInput = document.getElementById('cantidad');
        const infoText = document.getElementById('infoDevolucion');
        const errorText = document.getElementById('errorCantidad');
        const form = document.getElementById('formDevolucion');

        function actualizarInfo() {
            const option = selectDetalle.options[selectDetalle.selectedIndex];
            const comprado = parseInt(option.getAttribute('data-cantidad')) || 0;
            const devuelto = parseInt(option.getAttribute('data-devuelto')) || 0;
            const restante = comprado - devuelto;

            if (option.value) {
                infoText.textContent = `Ya se devolvieron ${devuelto} unidades de ${comprado}. Puedes devolver hasta ${restante}.`;
            } else {
                infoText.textContent = '';
            }
        }

        // Mostrar info al cambiar el detalle
        selectDetalle.addEventListener('change', actualizarInfo);
        actualizarInfo();

        // Validar cantidad antes de enviar
        cantidadInput.addEventListener('input', function() {
            const option = selectDetalle.options[selectDetalle.selectedIndex];
            const comprado = parseInt(option.getAttribute('data-cantidad')) || 0;
            const devuelto = parseInt(option.getAttribute('data-devuelto')) || 0;
            const restante = comprado - devuelto;
            const cantidad = parseInt(cantidadInput.value);

            if (cantidad > restante) {
                errorText.classList.remove('d-none');
            } else {
                errorText.classList.add('d-none');
            }
        });

        form.addEventListener('submit', function(e) {
            const option = selectDetalle.options[selectDetalle.selectedIndex];
            const comprado = parseInt(option.getAttribute('data-cantidad')) || 0;
            const devuelto = parseInt(option.getAttribute('data-devuelto')) || 0;
            const restante = comprado - devuelto;
            const cantidad = parseInt(cantidadInput.value);

            if (cantidad > restante) {
                e.preventDefault();
                errorText.classList.remove('d-none');
            }
        });
    };
</script>

</body>
</html>
