<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Login | BioPharma</title>
    <style>
        body {
    display: flex;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    font-family: "Poppins", serif;
    background-color: #0b1522;
}

.heart {
    height: 250px;
    width: 250px;
    background-color: #f20044;
    position: relative;
    transform: rotate(-45deg);
    box-shadow: -10px 10px 90px #f20044;
    animation: heart 0.6s linear infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 18px;
    text-align: center;
    padding: 10px;
    flex-direction: column;
    display: flex;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    font-family: "Poppins", serif;
    background-color: #0b1522;
}

.heart h1 {
    font-size: 24px;
    margin: 0;
    z-index: 9999;
}

.heart img {
    max-width: 100px;
    height: auto;
    z-index: 9999;
}

.heart p {
    position: absolute;
    z-index: 9999;
    width: 100%;
    transform: rotate(45deg) translate(0,-50px);
}

@keyframes  heart {
    0% {
        transform: rotate(-45deg) scale(1.07);
    }
    80% {
        transform: rotate(-45deg) scale(1.0);
    }
    100% {
        transform: rotate(-45deg) scale(0.8);
    }
}

.heart::before {
    content: "";
    position: absolute;
    height: 200px;
    width: 200px;
    background-color: #f20044;
    top: -50%;
    border-radius: 100px;
    box-shadow: -10px -10px 90px #f20044;
}

.heart::after {
    content: "";
    position: absolute;
    height: 200px;
    width: 200px;
    background-color: #f20044;
    right: -50%;
    border-radius: 100px;
    box-shadow: 10px 10px 90px #f20044;
}

    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-panel">
            <div class="heart">
                <h1>BIOPHARMA</h1>
                <img src="{{ asset('logo.png') }}" alt="Logo de BioPharma" />
            </div>
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
