<?php
session_start(); // Iniciar la sesión

// Verificar si existe la variable de sesión 'nombre'
if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = 'Log In'; // Texto predeterminado si no se ha iniciado sesión
}

$json_file = 'playlist/playlist-1.json';
$json_data = file_get_contents($json_file);
$music_data = json_decode($json_data, true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>La Gramola</title>
</head>
<body>
    <div class="container">

        <div class="container-A">

            <div class="container-logIn">
                <!-- Cambiar el texto del enlace por el nombre -->
                <a href="LogIn.php"><?php echo $nombre; ?></a>
            </div>
            <!-- Resto de tu código HTML existente -->

            <div class="track-art"></div>

            <div class="control-box">

                <div class="slider-container">

                    <div class="current-time">00:00</div>
                    <input type="range" min="1" max="100" value="0" class="seek-slider" onchange="seekTo()">
                    <div class="total-duration">00:00</div>

                </div>

                <div class="buttons">

                    <div class="repeat-track">
                        <i class="fa fa-repeat fa-2x"></i>
                    </div>

                    <div class="prev-track" onclick="prevTrack()">
                        <i class="fa fa-step-backward fa-2x"></i>
                    </div>

                    <div class="playpause-track" onclick="playpauseTrack()">
                        <i class="fa fa-play-circle fa-2x"></i>
                    </div>

                    <div class="next-track" onclick="nextTrack()">
                        <i class="fa fa-step-forward fa-2x"></i>
                    </div>

                    <div class="random-track" onclick="randomTrack()">
                        <i class="fas fa-random fa-2x" title="random"></i>
                    </div>

                </div>

                <div class="slider-container-2">

                        <i class="fa fa-volume-down"></i>
                        <input type="range" min="1" max="100" value="100" class="volume-slider">
                        <i class="fa fa-volume-up"></i>

                </div>

                

            </div>


        </div>


        <div class="container-B">






        </div>

    </div>
    <script>
    var musicList = <?php echo json_encode($music_data); ?>;
    </script>
    <script src="app.js"></script>

</body>
</html>