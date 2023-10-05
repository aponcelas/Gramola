<?php

// Obtenim totes les cookies
$all_cookies = $_COOKIE;

// Creem un array per guardar l'informació de les cookies
$playlist_info = array();

// Obtener la información de uso de cada playlist
foreach ($all_cookies as $cookie_name => $cookie_value) {

    //  Comprovem si el nom de la cookie comença per playlist_
    if (strpos($cookie_name, 'playlist_') === 0) {

        // Si comença per playlist_, ho eliminem del nom de la cookie
        $playlist_name = substr($cookie_name, 9);

        // Guardem el valor de la cokkie a $playlist_info
        $playlist_info[$playlist_name] = $cookie_value;
    }
}

// Ordenem les playlists de més a menys utilitzades, alfabeticament
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

    <!--Contenidor principal-->
    <div class="container">

        <!--Contenidor fill-->
        <div class="container-card">

            <!--Contenidor per les cookies-->
            <div class="cookies">

                <!--Contenidor pel top playlists-->
                <div class="top-playlists">

                    <!--Títol per les top playlists-->
                    <h1>TOP PLAYLISTS</h1>
                    <?php

                    // Si el contador de les playlists és més gran a 0...
                    if (count($playlist_info) > 0) {

                        // Creem una llista ordenada...
                        echo "<ol>";

                        // Per cada element de $playlist_info
                        foreach ($playlist_info as $playlist_name => $usage_count) {

                            // Mostrem el nom de la playlist i el nombre de vegades que ha estat reproduïda
                            echo "<li><p>Playlist: $playlist_name ($usage_count vegades reproduïda).</p></li>";
                        }
                        echo "</ol>";
                    }
                    ?>
                </div>


                <!--Contenidor per la última playlist reproduïda-->
                <div class="last-playlist">

                    <!--Títol per a la última playlist utilitzada-->
                    <h1>ÚLTIMA PLAYLIST UTILITZADA</h1>
                    <?php

                    // Comprovem si hi ha alguna cookie amb el nom last_playlist
                    if (isset($_COOKIE["last_playlist"])) {

                        // Separem la informació emmagatzemada de la cookie
                        $last_playlist_info = explode("|", $_COOKIE["last_playlist"]);

                        // En la primera posició hi guardem el nom de la cookie
                        $last_playlist_name = $last_playlist_info[0];

                        // En la segona posició hi guardem la data en el cual hem seleccionat la playlist
                        $last_playlist_timestamp = $last_playlist_info[1];

                        // Modifiquem el nom de la playlist sense l'extensió
                        $playlist = pathinfo($last_playlist_name, PATHINFO_FILENAME);

                        // Creem u a llista desordenada
                        echo "<ul>";

                        // Mostrem el nom de la playlist
                        echo "<li><p>Nombre de la Playlist: $playlist.</p></li>";

                        // Mostrem la data d'utilització formatada
                        echo "<li><p>Fecha de Utilización: " . date("l, d F Y", $last_playlist_timestamp) ."</p></li>";
                        echo "</ul>";
                    } 
                    ?>
                </div>
            </div>

            <!--Contenidor per al reproductor de música-->
            <div class="personal-info">

                <!--Anar al reproductor de música-->
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
