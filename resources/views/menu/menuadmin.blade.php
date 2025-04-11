<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menú Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Inventario -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="inventarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inventario
          </a>
          <ul class="dropdown-menu" aria-labelledby="inventarioDropdown">
            <li><a class="dropdown-item" href="/medicamento">Medicamentos</a></li>
            <li><a class="dropdown-item" href="/entrada">Entradas</a></li>
            <li><a class="dropdown-item" href="/salida">Salidas</a></li>
          </ul>
        </li>

        <!-- Ventas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="ventasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ventas
          </a>
          <ul class="dropdown-menu" aria-labelledby="ventasDropdown">
            <li><a class="dropdown-item" href="/venta">Realizar Venta</a></li>
            <li><a class="dropdown-item" href="/devolucion">Devoluciones</a></li>
          </ul>
        </li>

        <!-- Usuarios -->
        <li class="nav-item">
          <a class="nav-link" href="/usuario">Usuarios</a>
        </li>

      </ul>
      <span class="navbar-text text-white me-3">
        Bienvenido, {{ $usuario->nombre }} ({{ ucfirst($usuario->rol) }})
      </span>
      <a class="btn btn-danger" href="/login"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>
  </div>
</nav>
