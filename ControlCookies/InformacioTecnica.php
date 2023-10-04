<?php
session_start();
if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = "Usuario no identificado";
}

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

// Ordenar las playlists primero por contador de uso (de más usadas a menos usadas) y luego alfabéticamente
array_multisort(array_values($playlist_info), SORT_DESC, array_keys($playlist_info), SORT_ASC, $playlist_info);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Información Técnica</title>
</head>
<body>

    <div class="container">

        <div class="container-card">

        <div class="container-info">

            <div class="log-in">
                <p><?php echo $nombre; ?></p>            
            </div>

            </div>

            <div class="cookies">

                <div class="top-playlists">
                    <h1>TOP PLAYLISTS</h1>
                    <?php
                    if (count($playlist_info) > 0) {
                        echo "<ol>";
                        foreach ($playlist_info as $playlist_name => $usage_count) {
                            echo "<li><p>Playlist: $playlist_name ($usage_count vegades reproduïda).</p></li>";
                        }
                        echo "</ol>";
                    }
                    ?>
                </div>


                <div class="last-playlist">
                <h1>ÚLTIMA PLAYLIST UTILITZADA</h1>
                    <?php
                    if (isset($_COOKIE["last_playlist"])) {
                        $last_playlist_info = explode("|", $_COOKIE["last_playlist"]);
                        $last_playlist_name = $last_playlist_info[0];
                        $last_playlist_timestamp = $last_playlist_info[1];

                        $playlist = pathinfo($last_playlist_name, PATHINFO_FILENAME);

                        echo "<ul>";
                            echo "<li><p>Nombre de la Playlist: $playlist.</p></li>";
                            echo "<li><p>Fecha de Utilización: " . date("l, d F Y", $last_playlist_timestamp) ."</p></li>";
                        echo "</ul>";
                    } 
                    ?>
                </div>

            </div>

            <div class="personal-info">
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>


        </div>

    </div>

</body>
</html>
