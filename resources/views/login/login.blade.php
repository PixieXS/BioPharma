<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8; /* Fondo suave y claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 40px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: linear-gradient(145deg, #3b4a5d, #ffffff); /* Fondo azul oscuro con transición suave */
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #003366; /* Azul oscuro */
            font-size: 2.5rem;
        }

        .login-container h2 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #003366; /* Azul oscuro */
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            color: #003366; /* Azul oscuro para las etiquetas */
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #003366; /* Azul oscuro al enfocarse */
            box-shadow: 0 0 8px rgba(0, 51, 102, 0.5);
        }

        .btn-custom {
            background-color: #003366; /* Azul oscuro */
            color: white;
            border-radius: 25px;
            width: 100%;
            padding: 12px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #002244; /* Azul más oscuro al hacer hover */
        }

        .error-message {
            color: #e53935;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #003366;
            font-size: 12px;
            position: absolute;
            bottom: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
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

    <div class="footer">
        <p>&copy; 2025 BioPharmacy. Todos los derechos reservados.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
