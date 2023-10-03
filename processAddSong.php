<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $audio_url = $_FILES['audio_url']['tmp_name'];
    $cover_url = $_FILES['cover_url']['tmp_name'];
    $selected_playlist = $_POST['selected_playlist'];

    // Verificar si se seleccionó un archivo JSON válido
    if (file_exists($selected_playlist) && pathinfo($selected_playlist, PATHINFO_EXTENSION) == 'json') {
        // Cargar el contenido del archivo JSON
        $json_data = file_get_contents($selected_playlist);
        $music_data = json_decode($json_data, true);

        // Agregar la nueva canción al arreglo existente
        $new_song = array(
            "title" => $title,
            "artist" => $artist,
            "url" => "songs/" . $_FILES['audio_url']['name'],
            "cover" => "cover/" . $_FILES['cover_url']['name']
        );

        $music_data[] = $new_song;

        // Guardar el arreglo actualizado en el archivo JSON
        file_put_contents($selected_playlist, json_encode($music_data, JSON_PRETTY_PRINT));

        // Mover los archivos de audio y portada a las carpetas correspondientes
        move_uploaded_file($_FILES['audio_url']['tmp_name'], "songs/" . $_FILES['audio_url']['name']);
        move_uploaded_file($_FILES['cover_url']['tmp_name'], "cover/" . $_FILES['cover_url']['name']);

        // Redireccionar de nuevo a index.php
        header("Location: index.php");
        exit();
    }
}
?>