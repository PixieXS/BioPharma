<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
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
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .page-header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
    </style>
    <script>
        // Establecer la fecha actual en el campo de fecha cuando la página se carga
        window.onload = function() {
            const fechaInput = document.querySelector('input[name="fecha"]');
            const today = new Date();
            const year = today.getFullYear();
            const month = ('0' + (today.getMonth() + 1)).slice(-2); // Asegura que el mes tenga dos dígitos
            const day = ('0' + today.getDate()).slice(-2); // Asegura que el día tenga dos dígitos
            const currentDate = `${year}-${month}-${day}`;
            fechaInput.value = currentDate; // Establece la fecha actual
        };
    </script>
</head>
<body>
<div class="container my-5">
    <div class="page-header">
        <h1 class="text-center">Registrar Venta</h1>
    </div>

    <form method="POST" action="{{ route('venta.store') }}">
        @csrf

        <!-- Usuario -->
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario que realiza la venta:</label>
            <input type="text" id="usuario_id" class="form-control" value="{{ Auth::user()->nombre }}" disabled>
            <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
        </div>

        <!-- Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>

        <h5>Medicamentos</h5>
        <div id="medicamentos-container">
            <div class="row mb-3 medicamento-item">
                <div class="col-md-5">
                    <label for="medicamento_id_0" class="form-label">Medicamento:</label>
                    <select name="medicamentos[0][medicamento_id]" id="medicamento_id_0" class="form-select medicamento-select" required>
                        <option value="">Seleccione medicamento</option>
                        @foreach ($medicamentos as $med)
                            <option 
                                value="{{ $med->id }}" 
                                data-precio="{{ $med->precio }}" 
                                data-stock="{{ $med->stock }}">
                                {{ $med->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_0" class="form-label">Cantidad:</label>
                    <input type="number" name="medicamentos[0][cantidad]" id="cantidad_0" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-3">
                    <label for="precio_unitario_0" class="form-label">Precio:</label>
                    <input 
                        type="number" 
                        name="medicamentos[0][precio_unitario]" 
                        id="precio_unitario_0"
                        class="form-control precio-input" 
                        placeholder="Precio" 
                        step="0.01" 
                        min="0" 
                        readonly
                    >
                </div>
            </div>
        </div>

        <button type="button" id="add-medicamento" class="btn btn-info btn-sm mt-3">+ Añadir otro medicamento</button>

        <div class="mt-4">
            <button type="submit" class="btn btn-success btn-custom">Guardar Venta</button>
            <a href="{{ route('venta.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let index = 1;

        document.querySelector('.medicamento-select').addEventListener('change', function () {
            handleMedicamentoSelect(this);
        });

        document.getElementById('add-medicamento').addEventListener('click', function () {
            const container = document.getElementById('medicamentos-container');

            const newItem = document.createElement('div');
            newItem.classList.add('row', 'mb-3', 'medicamento-item');

            newItem.innerHTML = `
                <div class="col-md-5">
                    <label for="medicamento_id_${index}" class="form-label">Medicamento:</label>
                    <select name="medicamentos[${index}][medicamento_id]" id="medicamento_id_${index}" class="form-select medicamento-select" required>
                        <option value="">Seleccione medicamento</option>
                        @foreach ($medicamentos as $med)
                            <option 
                                value="{{ $med->id }}" 
                                data-precio="{{ $med->precio }}" 
                                data-stock="{{ $med->stock }}"/>
                                {{ $med->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_${index}" class="form-label">Cantidad:</label>
                    <input type="number" name="medicamentos[${index}][cantidad]" id="cantidad_${index}" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-3">
                    <label for="precio_unitario_${index}" class="form-label">Precio:</label>
                    <input 
                        type="number" 
                        name="medicamentos[${index}][precio_unitario]" 
                        id="precio_unitario_${index}"
                        class="form-control precio-input" 
                        placeholder="Precio" 
                        step="0.01" 
                        min="0" 
                        readonly
                    >
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-medicamento">X</button>
                </div>
            `;

            container.appendChild(newItem);

            newItem.querySelector('.medicamento-select').addEventListener('change', function () {
                handleMedicamentoSelect(this);
            });

            newItem.querySelector('.remove-medicamento').addEventListener('click', function () {
                this.closest('.medicamento-item').remove();
            });

            index++;
        });

        function handleMedicamentoSelect(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio');
            const stock = selectedOption.getAttribute('data-stock');
            const precioInput = selectElement.closest('.medicamento-item').querySelector('.precio-input');

            if (parseInt(stock) <= 0) {
                alert('Este medicamento está agotado.');
                selectElement.value = "";
                precioInput.value = "";
            } else {
                precioInput.value = precio;
            }
        }
    });
</script>
</body>
</html>
