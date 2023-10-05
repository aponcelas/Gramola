<?php
// Iniciem la sessió
session_start();

// Comprovem si hi ha alguna sessió oberta a $_SESSION['user']
if (isset($_SESSION['user'])) {

    // Si hi ha alguna sessió oberta, guardem el valor a $usuari
    $usuari = $_SESSION['user'];
} else {

    // Si no hi ha cap sessió iniciada, mostrarà un botó per anar a la pàgina de LogIn
    $usuari = "<a href='ControlSessions/LogIn.php'><button class='login-button'>Iniciar sessió</button></a>";
}

// Variable que guarda el directori de tots el fitxers JSON
$playlist_dir = 'Playlists/';

// Variable que guarda tots els fitxers JSON de la carpeta Playlists 
$playlist_files = glob($playlist_dir . '*.json');

// Comprovem si s'ha seleccionat una playlist
if (isset($_GET['selected_playlist'])) {

    // Si s'ha enviat la playlist, l'assignem a la variable $selected_playlist
    $selected_playlist = $_GET['selected_playlist'];

    // Guardem el nom de la cookie per cada playlist seleccionada
    $cookie_name = "playlist_" . pathinfo($selected_playlist, PATHINFO_FILENAME);

    // Comprovem si existeix la cookie amb el valor de la variable $cookie_name;
    if (isset($_COOKIE[$cookie_name])) {

        // Si existeix la cookie, obtenim el su valor, sumen + 1 per tenir un contador de cuantes vegades 
        // s'ha carregat i assignem el valor a $cookie_value
        $cookie_value = $_COOKIE[$cookie_name] + 1;
    } else {

        // Si la cookie no existeix, li posem un valor per defecte 1 
        $cookie_value = 1;
    }

    // Establim les cookies per poder fer un top de playlists amb un temps de vida de 30 dies
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

    // Establim les cookies per poder saber quina és la última playlist seleccionada
    setcookie("last_playlist", $selected_playlist . "|" . time(), time() + (86400 * 30), "/");

// Si no s'ha seleccionat cap playlist
} elseif (!empty($playlist_files)) {

    // Carregarem la primera playlist de la carpeta Playlists
    $selected_playlist = $playlist_files[0];
}

// Funció per cargar les dades del fitxer JSON
function loadMusicData($playlist_file) {

    // Comprovem si el fitxer JSON existeix
    if (file_exists($playlist_file)) {

        // Si el fitxer existeix, guardem el contingut del fitxer JSON en la variable $json_data
        $json_data = file_get_contents($playlist_file);

        // Retornem el contingut de $json_data descodificat
        return json_decode($json_data, true);
    
    // Si el fixter JSON no existeix...
    } else {

        //Retornem un array buit
        return array();
    }
}

// Carguem les dades de la playlist seleccionada
$music_data = loadMusicData($selected_playlist);

// Convertim les dades per poder utilitzar-ho en el codi Javascript
$music_data_js = json_encode($music_data);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>La Gramola</title>
</head>
<body>

    <!--Contenidor principal-->
    <div class="container">

        <!--Contenidor pel reproductor-->
        <div class="container-card">

            <!--Contenidor pel LogIn/LogOut i la pàgina amb la informació de les cookies-->
            <div class="container-info">
                
                <!--Contenidor pel LogIn/LogOut-->
                <div class="log-in">

                    <!--Nom del usuari-->
                    <p><?php echo $usuari; ?></p>

                    <!--Boto que tancar sessió-->
                    <a href="ControlSessions/processLogOut.php"><button class="logout-button">Tancar sessió</button></a>
                </div>

                <!--Contenidor per la pàgina amb la informació de les cookies-->
                <div class="personal-info">

                    <!--Anar a la pàgina amb la informació de les cookies-->
                    <a href="ControlCookies/InformacioTecnica.php">Informació tècnica</a>
                </div>
            </div>

            <!--Contenidor amb la cover-->
            <div class="track-art"></div>

            <!--Contenidor amb el controls del reproductor-->
            <div class="control-box">

                <!--Container per a la barra de reproducció-->
                <div class="audio-slider">

                    <!--Contenidor pel temps real de la cançó-->
                    <div class="current-time">0:00</div>

                    <!--Input per a la barra de reproducció-->
                    <input type="range" min="0" max="100" value="0" class="seek-slider">
                    
                    <!--Contenidor per a temps total de la cançó-->
                    <div class="total-duration">0:00</div>
                </div>

                <!--Contenidor pel control dels botons del reproductor-->
                <div class="buttons">

                    <!--Botó per reiniciar la cançó-->
                    <div class="repeat-song">
                        <i class="fa fa-repeat fa-2x"></i>
                    </div>

                    <!--Botó per canviar a la cançó anterior-->
                    <div class="prev-song" >
                        <i class="fa fa-step-backward fa-2x"></i>
                    </div>
                    
                    <!--Botó per pausar o seguir amb la reproducció de la cançó-->
                    <div class="playpause-song" >
                        <i class="fa fa-play-circle fa-2x"></i>
                    </div>

                    <!--Botó per canviar a la següent cançó-->
                    <div class="next-song" >
                        <i class="fa fa-step-forward fa-2x"></i>
                    </div>

                    <!--Botó per posar una cancó random-->
                    <div class="random-song" >
                        <i class="fas fa-random fa-2x" title="random"></i>
                    </div>
                </div>
            </div>

            <!--Sound Wave-->
            <div class="boxContainer hidden">
                <div class="box box1"></div>
                <div class="box box2"></div>
                <div class="box box3"></div>
                <div class="box box4"></div>
                <div class="box box5"></div>
            </div>

            <!--Contenidor per a la selecció de playlists i cançons-->
            <div class="playlist-songs">

                <!--Contenidor per a la selecció de cançons-->
                <div class="selected-song">

                    <!--Desplegable per la tria de les cançons-->
                    <select name="selected_song" id="selected_song">

                        <!--Per la playlist cargada...-->
                        <?php foreach ($music_data as $index => $song) : ?>

                            <!--Per cada opció, guardem l'index de cada cançó en el value-->
                            <option value="<?php echo $index; ?>">

                                <!--Mostrem en el desplegable el nom de la cançó-->
                                <?php echo $song['title']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!--Anar a la pàgina per afegir una cançó-->
                    <a href="ControlSongs/AddSong.php"><button class="add-song">+</button></a>
                </div>

                <!--Contenidor per a la selecció de playlists-->
                <div class="selected-playlist">

                    <!--Desplegable per a la selecció de playlists-->
                    <select name="selected_playlist" id="selected_playlist">

                        <!--Per cada playlists de la carpeta Playlists-->
                        <?php foreach ($playlist_files as $playlist_file) : ?>

                            <!--Guardem el nom del arxiu JSON sense l'extensió i ho convertim a majúscules-->
                            <?php $playlist_name = strtoupper(pathinfo($playlist_file, PATHINFO_FILENAME)); ?>

                            <!--Per cada opció, guardem la ruta de cada playlist y editem l'enllaç per saber quina playlist tenim carregada-->
                            <option value="<?php echo $playlist_file; ?>" <?php echo ($selected_playlist == $playlist_file) ? 'selected' : ''; ?>>

                                <!--Mostrem en el desplegable el nom de les playlists-->
                                <?php echo $playlist_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!--Anar a la pàgina per afegir playlists-->
                    <a href="ControlPlaylists/AddPlaylist.php"><button class="add-playlist">+</button></a>
                </div>
            </div>
        </div>
    </div>

    <script>var musicList = <?php echo $music_data_js; ?>;</script>
    <script src="app.js"></script>
</body>
</html>