<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | BioPharma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* Se incluye el CSS en esta sección para referencia */
    body {
      display: flex;
      min-height: 100vh;
      align-items: center;
      justify-content: center;
      font-family: "Poppins", sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }

    .main-container {
      display: flex;
      min-height: 100vh;
    }

    .left-panel {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right-panel {
      flex: 1;
      padding: 60px;
    }

    .heart {
      height: 250px;
      width: 250px;
      background-color: #4caf50;
      position: relative;
      transform: rotate(-45deg);
      animation: heartbeat 2s ease-in-out infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      font-size: 18px;
    }

    .heart h1 {
      z-index: 1;
      transform: rotate(45deg);
      font-size: 24px;
    }

    .heart img {
      position: absolute;
      z-index: 1;
      max-width: 80px;
      transform: rotate(45deg);
    }

    .heart:before,
    .heart:after {
      content: "";
      position: absolute;
      background-color: #4caf50;
      border-radius: 50%;
    }

    .heart:before {
      width: 150px;
      height: 150px;
      top: -75px;
      left: 25px;
    }

    .heart:after {
      width: 150px;
      height: 150px;
      left: -75px;
      top: 25px;
    }

    @keyframes heartbeat {
      0%, 100% {
        transform: rotate(-45deg) scale(1);
      }
      50% {
        transform: rotate(-45deg) scale(1.1);
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="left-panel">
      <div class="heart">
        <h1>BIOPHARMA</h1>
        <img src="{{ asset('logo.png') }}" alt="Logo BioPharma" />
      </div>
    </div>
    <div class="right-panel">
      <h2>Ingrese A Su Cuenta</h2>
      <p>Ingrese sus datos para iniciar sesión.</p>
      <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required autocomplete="email" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" />
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
      </form>
    </div>
  </div>
</body>
</html>
