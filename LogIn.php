<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    $_SESSION['nombre'] = $nombre;

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
            <form class="login-form" method="post">
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>
