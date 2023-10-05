<?php

// Iniciem la sessió
session_start(); 

// Comprovem si el mètode per enviar les dades és POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Si el mètode és POST, guardem en nom d'usuari a la sessió
    $_SESSION['user'] = $_POST['user'];

    // Redirigim al reproductor de música
    header('Location: ../index.php');
    exit;
}
?>