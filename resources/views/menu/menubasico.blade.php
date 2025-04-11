<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu - Farmacia BioPharma</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f4f7f8;
      margin: 0;
      height: 100vh;
      overflow: hidden;
    }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 260px;
      height: 100%;
      background: linear-gradient(135deg, #283c86, #45a247);
      color: #fff;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
      text-align: center;
      letter-spacing: 1px;
      margin-bottom: 30px;
      font-weight: 700;
    }
    .sidebar a {
      display: block;
      color: #e0e0e0;
      text-decoration: none;
      margin: 15px 0;
      padding: 12px 20px;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
    }
    .navbar-top {
      margin-left: 260px;
      height: 60px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 1001;
    }
    .navbar-top .user-info {
      font-size: 16px;
      color: #333;
    }
    .navbar-top .logout {
      color: #fff;
      background: #d9534f;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s, transform 0.2s;
    }
    .navbar-top .logout:hover {
      background: #c9302c;
      transform: scale(1.05);
    }
    .main-content {
      margin-left: 260px;
      margin-top: 60px;
      padding: 20px;
      height: calc(100% - 60px);
      overflow-y: auto;
      background: #f4f7f8;
    }
    .main-title {
      font-size: 32px;
      text-align: center;
      margin-top: 10px;
      margin-bottom: 30px;
      color: #333;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>BioPharma</h2>
    <a href="/venta"><i class="fas fa-shopping-cart"></i> Ventas</a>
    <a href="/inventario"><i class="fas fa-warehouse"></i> Inventario</a>
    <a href="/devolucion"><i class="fas fa-undo"></i> Devoluciones</a>
  </div>
  
  <!-- Navbar -->
  <div class="navbar-top">
    <div class="user-info">
      @if($usuario)
        Bienvenido, <strong>{{ $usuario->nombre }}</strong> ({{ ucfirst($usuario->rol) }})
      @endif
    </div>
    <div>
      <a href="/login" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>
  </div>
  
  <!-- Main Content -->
  <div class="main-content">
    <h1 class="main-title">Menú</h1>
    <p>Selecciona una opción del menú lateral para gestionar las ventas, inventarios o devoluciones.</p>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
