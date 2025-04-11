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
            background-color: #f1f8fc; /* Fondo suave y relajante */
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
            border-radius: 12px; /* Bordes más redondeados para un estilo más suave */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: linear-gradient(145deg, #e0f7fa, #ffffff); /* Fondo con un toque de color azul claro */
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #00796b; /* Color verde suave, relacionado con la salud */
            font-size: 2.5rem;
        }

        .login-container h2 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            color: #00796b; /* Coincide con el tema de la farmacia */
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #80cbc4; /* Borde suave en tonos verde agua */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Ligera sombra para destacar el campo */
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #00796b; /* Cambio de color al enfocarse, para mayor énfasis */
            box-shadow: 0 0 8px rgba(0, 150, 136, 0.5);
        }

        .btn-custom {
            background-color: #00796b; /* Verde suave, profesional y asociado a la salud */
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
            background-color: #004d40; /* Verde oscuro al hacer hover */
        }

        .error-message {
            color: #e53935; /* Rojo para los mensajes de error */
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #00796b;
            font-size: 12px;
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
