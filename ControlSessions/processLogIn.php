<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    $_SESSION['nombre'] = $nombre;

    header('Location: ../index.php');
    exit;
}
?>