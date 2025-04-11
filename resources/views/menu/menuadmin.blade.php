<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Admin - Farmacia BioPharma</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Base */
    body {
      font-family: 'Roboto', sans-serif;
      background: #f4f7f8;
      margin: 0;
      height: 100vh;
      overflow: hidden;
    }
    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 260px;
      background: linear-gradient(135deg, #283c86, #45a247);
      color: #fff;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 30px;
      font-weight: 700;
      letter-spacing: 1px;
    }
    .sidebar a {
      display: block;
      font-size: 16px;
      color: #e0e0e0;
      text-decoration: none;
      margin: 15px 0;
      padding: 12px 20px;
      border-radius: 4px;
      transition: background 0.3s, color 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
      color: #fff;
    }
    /* Top Navbar */
    .navbar-top {
      margin-left: 260px;
      height: 60px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      padding: 0 20px;
      justify-content: space-between;
    }
    .navbar-top .user-info {
      font-size: 16px;
      font-weight: 500;
      color: #333;
    }
    .navbar-top .logout {
      color: #fff;
      background: #d9534f;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .navbar-top .logout:hover {
      background: #c9302c;
    }
    /* Main Content */
    .main-content {
      margin-left: 260px;
      padding: 20px;
      height: calc(100% - 60px);
      overflow-y: auto;
      background: #f4f7f8;
    }
    .main-title {
      text-align: center;
      margin-bottom: 40px;
      color: #333;
      font-weight: 600;
      font-size: 32px;
    }
    /* Grid de Cards */
    .menu-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .menu-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      text-align: center;
      padding: 30px 20px;
      flex: 0 0 calc(33.333% - 20px);
      margin-bottom: 20px;
      text-decoration: none;
      color: #333;
    }
    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .menu-card i {
      font-size: 48px;
      margin-bottom: 15px;
      color: #45a247;
    }
    .menu-card span {
      display: block;
      font-size: 20px;
      font-weight: 600;
    }
    /* Responsive */
    @media (max-width: 768px) {
      .menu-card {
        flex: 0 0 calc(50% - 20px);
      }
    }
    @media (max-width: 480px) {
      .menu-card {
        flex: 0 0 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>BioPharma</h2>
    <a href="/usuario"><i class="fas fa-users"></i> Usuarios</a>
    <a href="/medicamento"><i class="fas fa-pills"></i> Medicamentos</a>
    <a href="/entrada"><i class="fas fa-arrow-circle-down"></i> Entradas</a>
    <a href="/salida"><i class="fas fa-arrow-circle-up"></i> Salidas</a>
    <a href="/venta"><i class="fas fa-shopping-cart"></i> Ventas</a>
    <a href="/devolucion"><i class="fas fa-undo"></i> Devoluciones</a>
  </div>

  <!-- Top Navbar -->
  <div class="navbar-top">
    <div class="user-info">
      @if($usuario)
        Bienvenido, <strong style="color:#45a247;">{{ $usuario->nombre }}</strong> ({{ ucfirst($usuario->rol) }})
      @endif
    </div>
    <div>
      <a href="/login" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1 class="main-title">Menú Administrativo</h1>
    <div class="menu-grid">
      <a href="/usuario" class="menu-card">
        <i class="fas fa-users"></i>
        <span>Usuarios</span>
      </a>
      <a href="/medicamento" class="menu-card">
        <i class="fas fa-pills"></i>
        <span>Medicamentos</span>
      </a>
      <a href="/entrada" class="menu-card">
        <i class="fas fa-arrow-circle-down"></i>
        <span>Entradas</span>
      </a>
      <a href="/salida" class="menu-card">
        <i class="fas fa-arrow-circle-up"></i>
        <span>Salidas</span>
      </a>
      <a href="/venta" class="menu-card">
        <i class="fas fa-shopping-cart"></i>
        <span>Ventas</span>
      </a>
      <a href="/devolucion" class="menu-card">
        <i class="fas fa-undo"></i>
        <span>Devoluciones</span>
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
