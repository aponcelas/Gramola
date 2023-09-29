<?php
session_start();

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = 'Log In';
}

$playlist_dir = 'playlist/';
$playlist_files = glob($playlist_dir . '*.json');

if (isset($_GET['selected_playlist'])) {
    $selected_playlist = $_GET['selected_playlist'];
} else {
    $selected_playlist = '';
}

if (!empty($selected_playlist) && in_array($selected_playlist, $playlist_files)) {
    $json_data = file_get_contents($selected_playlist);
    $music_data = json_decode($json_data, true);
} else {
    if (!empty($playlist_files)) {
        $json_data = file_get_contents($playlist_files[0]);
        $music_data = json_decode($json_data, true);
    } else {

        $music_data = array();
    }
}

$music_data_js = json_encode($music_data);
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

        <div class="">

            <div class="container-logIn">

            <a href="LogIn.php"><?php echo $nombre; ?></a>

            </div>


            <!-- Resto de tu código HTML existente -->

            <div class="track-art"></div>
            <div class="track-title"></div>
            <div class="track-artist"></div>

            <div class="control-box">

                <div class="slider-container">

                    <div class="current-time">00:00</div>
                    <input type="range" min="0" max="100" value="0" class="seek-slider" onchange="seekTo()">
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

                <div class="song-volume">

                <div class="select-song">

                    <select name="selected_track"  id="selected_track" class="selected-song">
                        <?php foreach ($music_data as $index => $track) : ?>
                            <option value="<?php echo $index; ?>"><?php echo $track['title']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-playlist">

                    <form method="get" action="index.php">
                            <select name="selected_playlist" id="selected_playlist" class="">
                                <?php foreach ($playlist_files as $playlist_file) : ?>
                                    <option value="<?php echo $playlist_file; ?>" <?php echo ($selected_playlist == $playlist_file) ? 'selected' : ''; ?>>
                                        <?php echo basename($playlist_file); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="Cargar Playlist">
                    </form>

                </div>




                </div>


            </div>


        </div>
    </div>
   

    <script>
        var musicList = <?php echo $music_data_js; ?>;
    </script>
    <script src="app.js"></script>

</body>
</html>