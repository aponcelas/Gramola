<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de la nueva playlist desde el formulario
    $newPlaylistName = $_POST["playlist"];

    // Verificar que el nombre de la playlist no esté vacío
    if (!empty($newPlaylistName)) {
        // Generar el nombre de archivo para la nueva playlist
        $newPlaylistFileName = 'playlist/' . strtolower(str_replace(" ", "_", $newPlaylistName)) . '.json';

        // Verificar si la playlist ya existe
        if (!file_exists($newPlaylistFileName)) {
            // Crear un archivo JSON vacío para la nueva playlist
            file_put_contents($newPlaylistFileName, json_encode([]));

            // Redirigir a index.php
            header("Location: index.php");
            exit();
        } 
    } 
}
?>