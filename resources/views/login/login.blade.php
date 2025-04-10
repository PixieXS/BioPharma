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
    background-color: #f4f6f8;
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
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.login-container h1 {
    margin-bottom: 20px;
    font-weight: bold;
    color: #007bff;
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
    background-color: #28a745;
    color: white;
    border-radius: 25px;
    width: 100%;
    padding: 12px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-custom:hover {
    background-color: #218838;
}

.error-message {
    color: red;
    font-size: 14px;
    text-align: center;
    margin-bottom: 20px;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
