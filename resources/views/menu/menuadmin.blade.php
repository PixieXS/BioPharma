<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Admin - BioPharma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2d6a4f;
            color: white;
            padding: 20px;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1b4332;
        }
        .navbar {
            width: 100%;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #edf2f7;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>BioPharma</h3>
        <a href="/usuario"><i class="fas fa-users"></i> Usuarios</a>
        <a href="/medicamento"><i class="fas fa-pills"></i> Medicamentos</a>
        <a href="/entrada"><i class="fas fa-arrow-circle-down"></i> Entradas</a>
        <a href="/salida"><i class="fas fa-arrow-circle-up"></i> Salidas</a>
        <a href="/venta"><i class="fas fa-shopping-cart"></i> Ventas</a>
        <a href="/devolucion"><i class="fas fa-undo"></i> Devoluciones</a>
    </div>

    <!-- Navbar -->
    <div class="content">
        <div class="navbar">
            @if($usuario)
                <span>Bienvenido: {{ $usuario->nombre }}</span>
            @endif
            <span>Menú Administrativo - BioPharma</span>
            <a href="/login" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>

        <!-- Contenido dinámico -->
        <div class="mt-4">
            @yield('contenido')
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
