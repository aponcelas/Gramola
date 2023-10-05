<?php 

// Iniciem la sessió
session_start();

// Destruim la sessió existént
session_destroy();

// Redirigim al reproductor de música
header('Location: ../index.php');
?>