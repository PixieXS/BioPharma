<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Entrada</title>
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
        };
    </script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Registrar Nueva Entrada</h1>
        <div class="card p-4">
            <form action="{{ route('entrada.store') }}" method="POST">
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
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Costo Unitario</label>
                    <input type="text" name="costo_unitario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" required readOnly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Proveedor</label>
                    <input type="text" name="proveedor" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('entrada.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
