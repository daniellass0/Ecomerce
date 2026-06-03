<?php

session_start();

if (isset($_SESSION['admin'])) {

    header("Location: admin.php");

    exit();

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador | TechStore</title>
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .login-container { max-width: 400px; margin: 5rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; }
        .form-login { display: flex; flex-direction: column; gap: 1rem; margin-top: 1.5rem; }
        .form-login input { padding: 0.8rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        .btn-ingresar { background-color: #007bff; color: white; border: none; padding: 1rem; cursor: pointer; font-weight: bold; border-radius: 4px; transition: 0.3s; }
        .btn-ingresar:hover { background-color: #0056b3; }
        .error-msg { color: #e74c3c; font-size: 0.9rem; display: none; margin-top: 0.5rem; }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>TechStore</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Volver a la tienda</a></li>
            </ul>
        </nav>
    </header>

    <main class="login-container">
        <h2>🔒 Acceso Restringido</h2>
        <p>Solo personal autorizado.</p>

        <form id="form-login" class="form-login">
            <input type="text" id="login-usuario" required placeholder="Usuario">
            <input type="password" id="login-password" required placeholder="Contraseña">
            <button type="submit" class="btn-ingresar">Ingresar al Sistema</button>
            <p id="mensaje-error" class="error-msg">Credenciales incorrectas.</p>
        </form>
    </main>

    <script src="./js/login.js"></script>
</body>
</html>