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

                {{-- Medicamento --}}
                <div class="mb-3">
                    <label for="medicamento_id" class="form-label">Medicamento</label>
                    <select name="medicamento_id" id="medicamento_id" class="form-select" required>
                        <option value="">Seleccione un medicamento</option>
                        @foreach ($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}" {{ old('medicamento_id', $devolucion->medicamento_id) == $medicamento->id ? 'selected' : '' }}>
                                {{ $medicamento->nombre }}
                            </option>
                        @endforeach
                    </select>
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
                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="{{ old('cantidad', $devolucion->cantidad) }}" required>
                </div>

                {{-- Fecha --}}
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $devolucion->fecha) }}" required readOnly>
                </div>

                {{-- Motivo --}}
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" maxlength="255" value="{{ old('motivo', $devolucion->motivo) }}" required>
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
