<?php
session_start();

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = "<a href='LogIn.php'><button class='login-button'>Log In</button></a>";
}

// Directorio donde se encuentran los archivos de lista de reproducción JSON
$playlist_dir = 'playlist/';

// Obtener la lista de archivos JSON en el directorio
$playlist_files = glob($playlist_dir . '*.json');

// Verificar si se ha proporcionado una lista de reproducción seleccionada en la URL y si es válida
if (isset($_GET['selected_playlist'])) {
    // Asignar la lista de reproducción seleccionada si es válida
    $selected_playlist = $_GET['selected_playlist'];

    // Actualizar el contador de uso de la playlist seleccionada
    $cookie_name = "playlist_" . pathinfo($selected_playlist, PATHINFO_FILENAME);
    $cookie_value = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] + 1 : 1;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Vence en 30 días

    setcookie("last_playlist", $selected_playlist, time() + (86400 * 30), "/");
} elseif (!empty($playlist_files)) {
    // Si no se proporcionó una lista de reproducción seleccionada o no es válida, seleccionar la primera lista de reproducción encontrada
    $selected_playlist = $playlist_files[0];
}

// Cargar los datos de la lista de reproducción seleccionada utilizando la función loadMusicData
$music_data = loadMusicData($selected_playlist);

// Convertir los datos de la lista de reproducción a formato JSON para su uso en JavaScript
$music_data_js = json_encode($music_data);

// Función para cargar los datos de la lista de reproducción desde un archivo JSON
function loadMusicData($playlist_file) {
    if (file_exists($playlist_file)) {
        // Leer el contenido del archivo JSON
        $json_data = file_get_contents($playlist_file);

        // Decodificar el contenido JSON en un array asociativo
        return json_decode($json_data, true);
    } else {
        // Si el archivo no existe, devolver un array vacío
        return array();
    }
}
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
    <title>La Gramola</title>
</head>
<body>

    <div class="container">

        <div class="container-card">

            <div class="container-info">

                <div class="log-in">
                    <p><?php echo $nombre; ?></p>
                    <a href="LogOut.php"><button class="logout-button">Log Out</button></a>
                </div>

                <div class="personal-info">
                    <a href="InformacioTecnica.php">Informació tècnica</a>
                </div>

            </div>

            <div class="track-art"></div>

            <div class="control-box">

                <div class="audio-slider">

                    <div class="current-time">0:00</div>

                    <input type="range" min="0" max="100" value="0" class="seek-slider" onchange="seekTo()">
                    
                    <div class="total-duration">0:00</div>

                </div>

                <div class="buttons">

                    <div class="repeat-track" onclick="repeatTrack()">
                        <i class="fa fa-repeat fa-2x"></i>
                    </div>

                    <div class="prev-track" >
                        <i class="fa fa-step-backward fa-2x"></i>
                    </div>

                    <div class="playpause-track" >
                        <i class="fa fa-play-circle fa-2x"></i>
                    </div>

                    <div class="next-track" >
                        <i class="fa fa-step-forward fa-2x"></i>
                    </div>

                    <div class="random-track" >
                        <i class="fas fa-random fa-2x" title="random"></i>
                    </div>

                </div>

            </div>

            <div class="playlist-songs">


                <div class="selected-song">
                    <select name="selected_track" id="selected_track">
                        <?php foreach ($music_data as $index => $track) : ?>
                            <option value="<?php echo $index; ?>"><?php echo $track['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="AddSong.php"><button class="add-song">+</button></a>
                </div>


            

                <div class="selected-playlist">
                    <select name="selected_playlist" id="selected_playlist">
                        <?php foreach ($playlist_files as $playlist_file) : ?>
                            <?php
                            $playlist_name = strtoupper(pathinfo($playlist_file, PATHINFO_FILENAME));
                            ?>
                            <option value="<?php echo $playlist_file; ?>" <?php echo ($selected_playlist == $playlist_file) ? 'selected' : ''; ?>>
                                <?php echo $playlist_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <a href="AddPlaylist.php"><button class="add-playlist">+</button></a>
                </div>

            </div>

        </div>

    </div>
   
    <script>var musicList = <?php echo $music_data_js; ?>;</script>
    <script src="app.js"></script>

</body>
</html>