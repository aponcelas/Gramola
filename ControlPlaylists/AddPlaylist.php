<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Afegir playlist</title>
</head>
<body>

    <div class="container">
        <div class="container-card">
            <h1>AFEGIR PLAYLIST</h1>

                <form action="processAddPlaylist.php" method="post" class="form">
                    <div class="label-input">
                        <label for="playlist"><p>Playlist:</p></label>
                        <input type="text" id="playlist" name="playlist" class="input-text" required>
                    </div>
                    
                    <input type="submit" value="Afegir playlist" class="submit-button">

                </form>

                <div class="personal-info">
                    <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
                </div>

        </div>
    </div>
</body>
</html>