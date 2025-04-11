<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDISYS - Menú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #edf2f7;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2d6a4f;
            min-height: 100vh;
            padding: 20px 10px;
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
            margin: 15px 0;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1b4332;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .welcome {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            color: #333;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .card-blue { background-color: #457b9d; }
        .card-green { background-color: #2d6a4f; }
        .card-orange { background-color: #e76f51; }
        .card-red { background-color: #6a4c93; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>MEDISYS</h3>
        <a href="#">Inicio</a>
        <a href="#">Datos de Medicamentos</a>
        <a href="#">Registro de Medicamentos</a>
        <a href="#">Reportes</a>
        <a href="#">Administrar Usuarios</a>
        <a href="#">Cambiar Contraseña</a>
    </div>

    <div class="content">
        <div class="welcome">Bienvenido Sistemas Webs a la aplicación de inventario de medicamentos</div>
        
        <div class="cards">
            <div class="card card-blue">Datos de Medicamentos<br><span style="font-size: 24px;">3</span></div>
            <div class="card card-green">Datos de Entrada<br><span style="font-size: 24px;">5</span></div>
            <div class="card card-orange">Stock Medicamentos<br><span style="font-size: 24px;">3</span></div>
            <div class="card card-red">Registros Medicamentos<br><span style="font-size: 24px;">5</span></div>
        </div>
    </div>
</body>
</html>
