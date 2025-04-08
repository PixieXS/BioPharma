<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Registrar Devolución</h1>
        <div class="card p-4">
            <form action="{{ route('devolucion.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Medicamento</label>
                    <select name="medicamento_id" class="form-select" required>
                        <option value="">Seleccione un medicamento</option>
                        @foreach ($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
    <label for="usuario_id" class="form-label">Usuario:</label>
    <input type="text" id="usuario_id" class="form-control" value="{{ Auth::user()->nombre }}" disabled>
    <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
</div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Motivo</label>
                    <input type="text" name="motivo" class="form-control" required>
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
