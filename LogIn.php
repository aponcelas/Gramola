<?php
session_start(); // Iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario y obtener el nombre
    $nombre = $_POST['nombre'];

    // Almacenar el nombre en una variable de sesión
    $_SESSION['nombre'] = $nombre;

    // Redireccionar a index.php después de procesar el formulario
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form class="login-form" method="POST">
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>
