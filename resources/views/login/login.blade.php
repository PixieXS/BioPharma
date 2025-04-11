<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | BioPharma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f3f3f3;
    }

    .main-container {
      display: flex;
      min-height: 100vh;
    }

    .left-panel {
      flex: 1;
      background-color: #444;
      background-image: url('{{ asset("fondo.png") }}');
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      position: relative;
    }

    .left-panel img {
      max-width: 250px;
      height: 250px;
      filter: drop-shadow(0px 4px 15px rgba(255, 255, 255, 0.6)); 
    }

    .left-panel h1 {
      font-size: 5rem;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
      margin-top: 20px;
      color: #3e8e41;
      text-align: center;
      text-shadow: -2px -2px 3px #ffffff, 2px 2px 4px rgba(0, 0, 0, 0.4);

    }

    .right-panel {
      flex: 1;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 60px 40px;
    }

    .right-panel h2 {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
    }

    .right-panel p {
      color: #777;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .form-label {
      font-weight: bold;
      color: #444;
    }

    .form-control {
      border-radius: 8px;
      padding: 12px;
      margin-bottom: 20px;
    }

    .btn-login {
      background-color: #4CAF50;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      width: 100%;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #3e8e41;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #aaa;
      margin-top: 40px;
    }

    .logo-placeholder {
      width: 100px;
      height: 100px;
      background-color: #eee;
      border-radius: 50%;
      margin-bottom: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #aaa;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="left-panel">
      <h1>BIOPHARMA</h1>
      <img src="{{ asset('logo.png') }}" alt="Imagen login" />
    </div>

    <div class="right-panel">
      <h2>Ingrese A Su Cuenta</h2>
      <p>Ingrese sus datos para iniciar sesión.</p>

      @if ($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first('email') }}
      </div>
      @endif

      <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn-login">LOGIN</button>
      </form>

      <div class="footer mt-5">
        &copy; 2025 BioPharma. Todos los derechos reservados. | Design by Grupo 2
      </div>
    </div>
  </div>
</body>
</html>
