<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Admin - Farmacia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* General */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
      margin: 0;
    }
    h1 {
      font-size: 36px;
      color: #2e7d32; /* Verde saludable */
      margin-bottom: 30px;
    }
    .user-info {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      color: #555;
      margin-bottom: 20px;
    }
    /* Contenedor del menú */
    .menu-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      margin-top: 30px;
    }
    /* Botones del menú */
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
    /* Colores específicos para cada opción, estilo farmacia */
    .usuarios {
      background-color: #4CAF50; /* Verde fresco */
    }
    .usuarios:hover {
      background-color: #43a047;
    }
    .medicamentos {
      background-color: #2196F3; /* Azul que transmite confianza */
    }
    .medicamentos:hover {
      background-color: #1976d2;
    }
    .entradas-entradas {
      background-color: #8BC34A; /* Verde claro */
    }
    .entradas-entradas:hover {
      background-color: #7cb342;
    }
    .salidas-salidas {
      background-color: #FFC107; /* Ámbar, tono cálido */
    }
    .salidas-salidas:hover {
      background-color: #ffb300;
    }
    .ventas {
      background-color: #F44336; /* Rojo */
    }
    .ventas:hover {
      background-color: #e53935;
    }
    .devoluciones {
      background-color: #9C27B0; /* Púrpura */
    }
    .devoluciones:hover {
      background-color: #8e24aa;
    }
    /* Botón de Cerrar Sesión */
    .logout-container {
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .logout {
      background-color: #d32f2f;
      padding: 10px 20px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s;
    }
    .logout:hover {
      background-color: #c62828;
    }
  </style>
</head>
<body>
  <!-- Botón Cerrar Sesión -->
  <div class="logout-container">
    <a href="/login" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
  </div>

  <!-- Usuario logueado -->
  @if($usuario)
    <div class="user-info">
      <p>Bienvenido, <span style="color: #2e7d32;">{{ $usuario->nombre }}</span> ({{ ucfirst($usuario->rol) }})</p>
    </div>
  @endif

  <!-- Título Principal -->
  <h1 class="text-center">Menú Administrativo</h1>

  <!-- Contenedor de Opciones -->
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
