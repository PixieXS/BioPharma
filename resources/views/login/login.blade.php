<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7f8;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .navbar {
            background-color: #283c86;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #283c86;
        }
        .login-container h2 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
        }
        .btn-custom {
            background-color: #283c86;
            color: white;
            border-radius: 25px;
            width: 100%;
            padding: 12px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #1e2b5b;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar con título centrado -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="#">BioPharmacy - Login</a>
        </div>
    </nav>

    <div class="container">
        <div class="login-container">
            <h1>BioPharmacy</h1>
            <p style="margin-top: -10px; color:#333; font-size: 14px;">versión 1.0</p>
            <h2>Iniciar Sesión</h2>

            @if ($errors->any())
                <div class="error-message">
                    <p>{{ $errors->first('email') }}</p>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn btn-custom">Ingresar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
