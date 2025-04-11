<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo - Farmacia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
    }
    .sidebar {
      height: 100vh;
      background-color: #1e2a38;
      padding-top: 20px;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 15px 20px;
      display: block;
      transition: background-color 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #0d6efd;
    }
    .content {
      margin-left: 220px;
      padding: 20px;
    }
    .topbar {
      background-color: #0d6efd;
      color: white;
      padding: 10px 20px;
      font-size: 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>

  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar position-fixed w-100" style="max-width: 220px;">
  <h4 class="text-center">💊 BIOPHARMA</h4>
  <a href="/inicio"><i class="fas fa-home me-2"></i>Inicio</a>
  <a href="/medicamento"><i class="fas fa-pills me-2"></i>Medicamentos</a>
  <a href="/entrada"><i class="fas fa-arrow-circle-down me-2"></i>Entradas</a>
  <a href="/salida"><i class="fas fa-arrow-circle-up me-2"></i>Salidas</a>
  <a href="/venta"><i class="fas fa-shopping-cart me-2"></i>Ventas</a>
  <a href="/devolucion"><i class="fas fa-undo me-2"></i>Devoluciones</a>
  <a href="/usuario"><i class="fas fa-users-cog me-2"></i>Usuarios</a>
</div>


    <!-- Contenido -->
    <div class="content w-100">
      <div class="topbar">
        <span>Bienvenido, {{ $usuario->nombre ?? 'Admin' }}</span>
        <a href="/login" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
      </div>

      <h2 class="mt-4">Contenido principal</h2>
      <p>Aquí puedes cargar tus vistas como `medicamento.index`, `venta.index`, etc.</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
