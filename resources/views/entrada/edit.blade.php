<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.onload = function() {
            const fechaInput = document.querySelector('input[name="fecha"]');
            const today = new Date();
            const year = today.getFullYear();
            const month = ('0' + (today.getMonth() + 1)).slice(-2);
            const day = ('0' + today.getDate()).slice(-2);
            const currentDate = `${year}-${month}-${day}`;
            fechaInput.value = currentDate;
            fechaInput.disabled = true;
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Editar Entrada</h1>
        <div class="card p-4">
            <form action="{{ route('entrada.update', $entrada->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Medicamento</label>
                    <select name="medicamento_id" class="form-select" required>
                        @foreach ($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}" 
                                {{ $entrada->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                                {{ $medicamento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" min="1" value="{{ $entrada->cantidad }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Costo Unitario</label>
                    <input type="text" name="costo_unitario" class="form-control" value="{{ $entrada->costo_unitario }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Proveedor</label>
                    <input type="text" name="proveedor" class="form-control" value="{{ $entrada->proveedor }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('entrada.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
