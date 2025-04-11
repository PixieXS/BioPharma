<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Admin - Farmacia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #edf2f7;
            display: flex;
            margin: 0;
            height: 100vh;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #2d6a4f;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar .menu-btn {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            border-radius: 10px;
            border: none;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .sidebar .menu-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .sidebar .menu-btn i {
            margin-right: 12px;
            font-size: 26px;
        }
        .sidebar .usuarios { background-color: #2d6a4f; }
        .sidebar .usuarios:hover { background-color: #1b4332; }
        .sidebar .medicamentos { background-color: #457b9d; }
        .sidebar .medicamentos:hover { background-color: #1d3557; }
        .sidebar .entradas-entradas { background-color: rgb(83, 190, 61); }
        .sidebar .entradas-entradas:hover { background-color: rgb(73, 165, 54); }
        .sidebar .salidas-salidas { background-color: #e76f51; }
        .sidebar .salidas-salidas:hover { background-color: #c74c3c; }
        .sidebar .ventas { background-color: #9c6644; }
        .sidebar .ventas:hover { background-color: #654321; }
        .sidebar .devoluciones { background-color: #264653; }
        .sidebar .devoluciones:hover { background-color: #1b2c36; }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .navbar {
            background-color: #2d6a4f;
            color: white;
            padding: 10px;
        }
        .navbar .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }
        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .logout {
            background-color: #e63946;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .logout:hover { background-color: #a4161a; }
        .user-info {
            font-size: 18px;
            font-weight: bold;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-info">
            @if($usuario)
                <p>Bienvenido, <span style="color: #2d6a4f;">{{ $usuario->nombre }}</span> ({{ ucfirst($usuario->rol) }})</p>
            @endif
        </div>
        <a href="/usuario" class="menu-btn usuarios"><i class="fas fa-users"></i>Usuarios</a>
        <a href="/medicamento" class="menu-btn medicamentos"><i class="fas fa-pills"></i>Medicamentos</a>
        <a href="/entrada" class="menu-btn entradas-entradas"><i class="fas fa-exchange-alt"></i>Entradas</a>
        <a href="/salida" class="menu-btn salidas-salidas"><i class="fas fa-exchange-alt"></i>Salidas</a>
        <a href="/venta" class="menu-btn ventas"><i class="fas fa-shopping-cart"></i>Ventas</a>
        <a href="/devolucion" class="menu-btn devoluciones"><i class="fas fa-undo"></i>Devoluciones</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar">
            <span class="navbar-brand">Farmacia Admin</span>
            <a href="/login" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav>

        <h1 class="text-center">Menú Administrativo</h1>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
