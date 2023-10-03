<?php
// Obtener todas las cookies
$all_cookies = $_COOKIE;

// Crear un array para almacenar información sobre todas las playlists y su contador de uso
$playlist_info = array();

// Obtener la información de uso de cada playlist
foreach ($all_cookies as $cookie_name => $cookie_value) {
    if (strpos($cookie_name, 'playlist_') === 0) {
        $playlist_name = substr($cookie_name, 9); // Eliminar "playlist_" del nombre de la cookie
        $playlist_info[$playlist_name] = $cookie_value;
    }
}

// Ordenar las playlists por contador de uso (de más usadas a menos usadas) y luego alfabéticamente
arsort($playlist_info);
ksort($playlist_info);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Información Técnica</title>
</head>
<body>
    <div class="container">
        <div class="container-card">
            <div class="playlist-songs">
                <h2>Playlists más usadas (ordenadas alfabéticamente):</h2>
                <?php
                if (count($playlist_info) > 0) {
                    echo "<ul>";
                    foreach ($playlist_info as $playlist_name => $usage_count) {
                        echo "<li>Nombre de la Playlist: $playlist_name - Usada $usage_count veces</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No se han utilizado playlists recientemente.</p>";
                }
                ?>

                <h2>Última Playlist Utilizada:</h2>
                <?php
                if (isset($_COOKIE["last_playlist"])) {
                    $last_playlist = $_COOKIE["last_playlist"];
                    $last_playlist_name = pathinfo($last_playlist, PATHINFO_FILENAME);
                    echo "<p>Nombre de la Playlist: $last_playlist_name</p>";
                    echo "<p>Fecha de Utilización: " . date("l, d F Y, H:i:s", filemtime($last_playlist)) . "</p>";
                } else {
                    echo "<p>No se ha utilizado ninguna Playlist recientemente.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
