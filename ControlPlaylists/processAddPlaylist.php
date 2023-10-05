<?php

// Comprovem si el mètode per enviar les dades és POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Creem la ruta de la nova playlist y la guardem a la variable $newPlaylistName
    $newPlaylistName = '../Playlists/' . str_replace(" ", "_", $_POST["playlist"]) . '.json';

    // Comprovem si ja existeix la playlist
    if (!file_exists($newPlaylistName)) {

        // Si el fitxer no existeix, creem un fitxer JSON per a la nova playlist
        file_put_contents($newPlaylistName, json_encode([]));

        // Redirigir al reproductor de música
        header("Location: ../index.php");
        exit();
    
    // Si el fitxer existeix...
    } else {

        // Redirigim al formualari per crear playlists i indiquem un error de playlist duplicada a la URL
        header("Location: AddPlaylist.php?error=duplicate_playlist");
        exit();
    }
}
?>