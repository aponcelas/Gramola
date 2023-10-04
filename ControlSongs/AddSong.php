<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Afegir cançó</title>
</head>
<body>
    <div class="container">

        <div class="container-card">

            <h1>AFEGIR CANÇÓ</h1>

            <form action="processAddSong.php" method="post" enctype="multipart/form-data" class="form">

                <div class="label-input">
                    <label for="title"><p>TÍTOL:</p></label>
                    <input type="text" id="title" name="title" placeholder="Títol de la cançó." class="input-text" required>
                </div>
                <div class="label-input">
                    <label for="artist"><p>ARTISTA:</p></label>
                    <input type="text" id="artist" name="artist" placeholder="Artista de la cançó." class="input-text" required>
                </div>

                <div class="label-input">
                    <label for="audio_url"><p>CANÇÓ:</p></label>
                    <input type="file" id="audio_url" name="audio_url" accept=".mp3" class="input-file" required>
                </div>

                <div class="label-input">
                    <label for="cover_url"><p>PORTADA:</p></label>
                    <input type="file" id="cover_url" name="cover_url" accept="image/*" placeholder="Cover" class="input-file" required>
                </div>

                <div class="label-input">
                    <label for="playlist"><p>PLAYLIST:</p></label>
                    <select name="selected_playlist" id="playlist">
                        <?php
                            $playlist_files = glob('../Playlists/*.json');
                            foreach ($playlist_files as $playlist_file) {
                                $playlist_name = strtoupper(pathinfo($playlist_file, PATHINFO_FILENAME));
                                echo "<option value='$playlist_file'>$playlist_name</option>";
                            }
                        ?>
                    </select>
                </div>

                <input type="submit" value="Afegir cançó" class="submit-button">

            </form>

            <div class="personal-info">
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>

        </div>

    </div>

</body>
</html>