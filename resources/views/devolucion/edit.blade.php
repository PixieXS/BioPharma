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
            <form action="{{ route('devolucion.update', $devolucion->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Detalle de Venta (con nombre del medicamento) --}}
                <div class="mb-3">
                    <label for="detalle_venta_id" class="form-label">Medicamento</label>
                    <select name="detalle_venta_id" id="detalle_venta_id" class="form-select" required>
                        <option value="">Seleccione un medicamento</option>
                        @foreach ($detalleVentas as $detalle)
                            <option value="{{ $detalle->id }}" 
                                {{ old('detalle_venta_id', $devolucion->detalle_venta_id) == $detalle->id ? 'selected' : '' }}>
                                {{ $detalle->medicamento->nombre }} - (Vendidos: {{ $detalle->cantidad }})
                            </option>
                        @endforeach
                    </select>
                    @error('detalle_venta_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Usuario (solo lectura) --}}
                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario</label>
                    <input type="text" id="usuario_id" class="form-control" value="{{ $devolucion->usuario->nombre }}" disabled>
                    <input type="hidden" name="usuario_id" value="{{ $devolucion->usuario->id }}">
                </div>

                {{-- Cantidad --}}
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" 
                        value="{{ old('cantidad', $devolucion->cantidad) }}" required>
                    @error('cantidad')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fecha --}}
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" 
                        value="{{ old('fecha', $devolucion->fecha) }}" required readonly>
                </div>

                {{-- Motivo --}}
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" maxlength="255" 
                        value="{{ old('motivo', $devolucion->motivo) }}" required>
                    @error('motivo')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('devolucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
