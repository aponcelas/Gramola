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
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body>

    <div class="container">

        <div class="container-card">

            <h1>LOG IN</h1>

            <form method="post" class="form">

                <div class="label-input">
                    <label for=""><p>USER:</p></label>
                    <input type="text" id="nombre" name="nombre" placeholder="User" class="input-text" required>
                </div>                
                
                <input type="submit" value="Log In" class="submit-button">
            </form>


        </div>

    </div>

</body>
</html>
