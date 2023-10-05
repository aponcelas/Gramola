<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Afegir cançó</title>
</head>
<body>

    <!--Contenidor principal-->
    <div class="container">

        <!--Contenidor pel formulari-->
        <div class="container-card">

            <!--Títol del formulari-->
            <h1>AFEGIR CANÇÓ</h1>
            
            <!--Formulari que processa les dades per afegir una cançó-->
            <form action="processAddSong.php" method="post" enctype="multipart/form-data" class="form">

                <!--Contenidor pel títol-->
                <div class="label-input">
                    <label for="title"><p>TÍTOL:</p></label>
                    <input type="text" id="title" name="title" placeholder="Títol de la cançó." class="input-text" required>
                </div>

                <!--Contenidor per l'artista-->
                <div class="label-input">
                    <label for="artist"><p>ARTISTA:</p></label>
                    <input type="text" id="artist" name="artist" placeholder="Artista de la cançó." class="input-text" required>
                </div>

                <!--Contenidor per la cançó-->
                <div class="label-input">
                    <label for="audio_url"><p>CANÇÓ:</p></label>
                    <input type="file" id="audio_url" name="audio_url" accept=".mp3" class="input-file" required>
                </div>

                <!--Contenidor per la portada-->
                <div class="label-input">
                    <label for="cover_url"><p>PORTADA:</p></label>
                    <input type="file" id="cover_url" name="cover_url" accept="image/*" placeholder="Cover" class="input-file" required>
                </div>

                <!--Contenidor per la playlist-->
                <div class="label-input">
                    <label for="playlist"><p>PLAYLIST:</p></label>

                    <!--Desplegable per la tria de la playlist-->
                    <select name="selected_playlist" id="playlist">
                        <?php
                        $playlist_files = glob('../Playlists/*.json'); // Obtenim tots els fitxers JSON

                        // Per cada fitxer...
                        foreach ($playlist_files as $playlist_file) {

                            // Obtenim el nom del fitxer amb majúscules i sense l'extensió JSON
                            $playlist_name = strtoupper(pathinfo($playlist_file, PATHINFO_FILENAME));
                            
                            // Mostrem el nom en el desplegable i guardem l'index de cada playlist al value
                            echo "<option value='$playlist_file'>$playlist_name</option>";
                        }
                        ?>
                    </select>
                </div>

                <!--Input per enviar les dades del formulari-->
                <input type="submit" value="Afegir cançó" class="submit-button">
            </form>

            <!--Contenidor per al reproductor de musica-->
            <div class="personal-info">

                <!--Anar al reproductor de musica-->
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>
        </div>
    </div>
</body>
</html>