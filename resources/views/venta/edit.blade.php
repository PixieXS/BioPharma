<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        h1 { font-weight: bold; color: #333; }
        .btn-custom { border-radius: 25px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center">Editar Venta</h1>
    <form action="{{ route('venta.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select class="form-select" id="usuario_id" name="usuario_id" required disabled>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $venta->usuario_id == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <h4 class="mt-4">Medicamentos:</h4>
        <div id="medicamentos-container">
            @foreach($venta->detalleVentas as $index => $detalle)
                <div class="card mb-3 medicamento-item" data-index="{{ $index }}">
                    <div class="card-body row">
                        <div class="col-md-5">
                            <label for="medicamento_{{ $index }}" class="form-label">Medicamento:</label>
                            <select id="medicamento_{{ $index }}" name="medicamentos[{{ $index }}][medicamento_id]" class="form-select medicamento-select" required>
                                @foreach($medicamentos as $medicamento)
                                    <option value="{{ $medicamento->id }}" {{ $detalle->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                                        {{ $medicamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cantidad_{{ $index }}" class="form-label">Cantidad:</label>
                            <input type="number" id="cantidad_{{ $index }}" name="medicamentos[{{ $index }}][cantidad]" class="form-control" value="{{ $detalle->cantidad }}" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="precio_{{ $index }}" class="form-label">Precio:</label>
                            <input type="number" id="precio_{{ $index }}" name="medicamentos[{{ $index }}][precio_unitario]" class="form-control precio-input" value="{{ $detalle->precio_unitario }}" step="0.01" readonly>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-medicamento" class="btn btn-secondary mb-3">Agregar Medicamento</button>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" id="total" name="total" class="form-control" value="{{ $venta->total }}" step="0.01" readonly>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="pendiente" {{ $venta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completada" {{ $venta->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                <option value="cancelada" {{ $venta->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-custom w-100">Actualizar Venta</button>
    </form>

    <a href="{{ route('venta.index') }}" class="btn btn-secondary btn-custom w-100 mt-3">Volver</a>
</div>

<script>
    let index = {{ count($venta->detalleVentas) }};
    const medicamentos = @json($medicamentos);
    const container = document.getElementById('medicamentos-container');

    document.getElementById('add-medicamento').addEventListener('click', () => {
        const item = document.createElement('div');
        item.classList.add('card', 'mb-3', 'medicamento-item');
        item.setAttribute('data-index', index);

        item.innerHTML = `
            <div class="card-body row">
                <div class="col-md-5">
                    <label for="medicamento_${index}" class="form-label">Medicamento:</label>
                    <select id="medicamento_${index}" name="medicamentos[${index}][medicamento_id]" class="form-select medicamento-select" required>
                        ${medicamentos.map(m => `<option value="${m.id}">${m.nombre}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_${index}" class="form-label">Cantidad:</label>
                    <input type="number" id="cantidad_${index}" name="medicamentos[${index}][cantidad]" class="form-control" min="1" required>
                </div>
                <div class="col-md-3">
                    <label for="precio_${index}" class="form-label">Precio:</label>
                    <input type="number" id="precio_${index}" name="medicamentos[${index}][precio_unitario]" class="form-control precio-input" step="0.01" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove">X</button>
                </div>
            </div>
        `;
        container.appendChild(item);
        index++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove')) {
            const item = e.target.closest('.medicamento-item');
            container.removeChild(item);
            calcularTotal();
        }
    });

    container.addEventListener('input', function (e) {
        if (e.target.classList.contains('medicamento-select') || e.target.classList.contains('form-control')) {
            calcularTotal();
        }
    });

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.medicamento-item').forEach(item => {
            const cantidad = item.querySelector('input[type="number"][name*="[cantidad]"]')?.value || 0;
            const precio = item.querySelector('input[type="number"][name*="[precio_unitario]"]')?.value || 0;
            total += parseFloat(cantidad) * parseFloat(precio);
        });
        document.getElementById('total').value = total.toFixed(2);
    }

    // Autocálculo de precio cuando se selecciona un medicamento
    container.addEventListener('change', function (e) {
        if (e.target.classList.contains('medicamento-select')) {
            const selectedId = e.target.value;
            const selectedMedicamento = medicamentos.find(m => m.id == selectedId);
            const parent = e.target.closest('.medicamento-item');
            const precioInput = parent.querySelector('.precio-input');
            if (selectedMedicamento && precioInput) {
                precioInput.value = selectedMedicamento.precio.toFixed(2);
                calcularTotal();
            }
        }
    });
</script>

</body>
</html>
