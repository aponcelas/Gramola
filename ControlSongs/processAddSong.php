<?php

// Comprovem si el mètode per enviar les dades és POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Guardem les dades del formulari en diferents variables
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $audio_url = $_FILES['audio_url']['tmp_name'];
    $cover_url = $_FILES['cover_url']['tmp_name'];
    $selected_playlist = $_POST['selected_playlist'];


    // Obtenim el contingut del la playlist seleccionada
    $json_data = file_get_contents($selected_playlist);

    // Descodifiquem el seu contingut
    $music_data = json_decode($json_data, true);

    // Creem un nou array amb els paràmetres del fitxer JSON amb les dades del formulari
    $new_song = array(
        "title" => $title,
        "artist" => $artist,
        "url" => "../URL/" . $_FILES['audio_url']['name'],
        "cover" => "../Cover/" . $_FILES['cover_url']['name']
    );

    // Afegim en nou array a la playlist
    $music_data [] = $new_song;

    // Codifiquen les en format JSON sobre la playlist seleccionada
    file_put_contents($selected_playlist, json_encode($music_data, JSON_PRETTY_PRINT));

    // Movem les dades de tipus fitxer a la seva carpeta corresponent
    move_uploaded_file($_FILES['audio_url']['tmp_name'], "../URL/" . $_FILES['audio_url']['name']);
    move_uploaded_file($_FILES['cover_url']['tmp_name'], "../Cover/" . $_FILES['cover_url']['name']);

    // Redirigir al reproductor de música
    header("Location: ../index.php");
    exit();
}
?>