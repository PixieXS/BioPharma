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
            padding: 20px;
        }
        h1 {
            font-size: 36px;
            color: #343a40;
            margin-bottom: 30px;
        }
        .user-info {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #555;
            margin-bottom: 20px;
        }
        .menu-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }
        .menu-btn {
            width: 320px;
            height: 80px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: none;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .menu-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .menu-btn i {
            margin-right: 12px;
            font-size: 26px;
        }
        .usuarios { background-color: #2d6a4f; }
        .usuarios:hover { background-color: #1b4332; }
        .medicamentos { background-color: #457b9d; }
        .medicamentos:hover { background-color: #1d3557; }
        .inventario { background-color: #6a4c93; }
        .inventario:hover { background-color: #3c096c; }
        .entradas-entradas { background-color:rgb(83, 190, 61); }
        .entradas-entradas:hover { background-color:rgb(73, 165, 54); }
        .salidas-salidas { background-color: #e76f51; }
        .salidas-salidas:hover { background-color: #c74c3c; }
        .ventas { background-color: #9c6644; }
        .ventas:hover { background-color: #654321; }
        .devoluciones { background-color: #264653; }
        .devoluciones:hover { background-color: #1b2c36; }
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
    </style>
</head>
<body>
    <div class="logout-container">
        <a href="/login" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>

    @if($usuario)
        <div class="user-info">
            <p>Bienvenido, <span style="color: #2d6a4f;">{{ $usuario->nombre }}</span> ({{ ucfirst($usuario->rol) }})</p>
        </div>
    @endif
    
    <h1 class="text-center">Menú Administrativo</h1>
    
    <div class="menu-container">
        <a href="/usuario" class="menu-btn usuarios"><i class="fas fa-users"></i>Usuarios</a>
        <a href="/medicamento" class="menu-btn medicamentos"><i class="fas fa-pills"></i>Medicamentos</a>
        <a href="/entrada" class="menu-btn entradas-entradas"><i class="fas fa-exchange-alt"></i>Entradas</a>
        <a href="/salida" class="menu-btn salidas-salidas"><i class="fas fa-exchange-alt"></i>Salidas</a>
        <a href="/venta" class="menu-btn ventas"><i class="fas fa-shopping-cart"></i>Ventas</a>
        <a href="/devolucion" class="menu-btn devoluciones"><i class="fas fa-undo"></i>Devoluciones</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
