<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Afegir playlist</title>
</head>
<body>

    <!--Contenidor principal-->
    <div class="container">

        <!--Contenidor pel formulari-->
        <div class="container-card">

            <!--Títol del formulari-->
            <h1>AFEGIR PLAYLIST</h1>

            <!--Formulari que processa les dades per afegir una playlist nova-->
            <form action="processAddPlaylist.php" method="post" class="form">

                <!--Contenidor per la playlist-->
                <div class="label-input">
                    <label for="playlist"><p>Playlist:</p></label>
                    <input type="text" id="playlist" name="playlist" class="input-text" required>
                </div>
                
                <!--Input per enviar les dades del formulari-->
                <input type="submit" value="Afegir playlist" class="submit-button">
            </form>

            <!--Contenidor pel reproductor de música-->
            <div class="personal-info">

                <!--Anar al reproductor de música-->
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>
        </div>
    </div>
</body>
</html>