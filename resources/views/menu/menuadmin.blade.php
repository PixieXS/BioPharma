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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDISYS - Menú Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2d6a4f;
            min-height: 100vh;
            padding: 20px;
            color: white;
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
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1b4332;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #edf2f7;
        }
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .menu-btn {
            width: 250px;
            height: 80px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .menu-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .usuarios { background-color: #2d6a4f; }
        .medicamentos { background-color: #457b9d; }
        .entradas { background-color: #83be3d; }
        .salidas { background-color: #e76f51; }
        .ventas { background-color: #9c6644; }
        .devoluciones { background-color: #264653; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>BIOPHARMA</h3>
        <a href="/usuario"><i class="fas fa-users"></i> Usuarios</a>
        <a href="/medicamento"><i class="fas fa-pills"></i> Medicamentos</a>
        <a href="/entrada"><i class="fas fa-arrow-circle-down"></i> Entradas</a>
        <a href="/salida"><i class="fas fa-arrow-circle-up"></i> Salidas</a>
        <a href="/venta"><i class="fas fa-shopping-cart"></i> Ventas</a>
        <a href="/devolucion"><i class="fas fa-undo"></i> Devoluciones</a>
    </div>

    <div class="content">
        @if($usuario)
            <div class="text-center mb-4">
                <h4>Bienvenido, <span style="color: #2d6a4f;">{{ $usuario->nombre }}</span> ({{ ucfirst($usuario->rol) }})</h4>
            </div>
        @endif
        
        <h1 class="text-center mb-4">Menú Administrativo</h1>
        
        <div class="menu-container">
            <a href="/usuario" class="menu-btn usuarios">Usuarios</a>
            <a href="/medicamento" class="menu-btn medicamentos">Medicamentos</a>
            <a href="/entrada" class="menu-btn entradas">Entradas</a>
            <a href="/salida" class="menu-btn salidas">Salidas</a>
            <a href="/venta" class="menu-btn ventas">Ventas</a>
            <a href="/devolucion" class="menu-btn devoluciones">Devoluciones</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</html>
