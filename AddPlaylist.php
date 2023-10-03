<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Añadir Playlist</title>
</head>
<body>

    <div class="container">
        <div class="container-card">
            <h1>ADD PLAYLIST</h1>

                <form action="processAddPlaylist.php" method="post" class="form">
                    <div class="label-input">
                        <label for="playlist"><p>Playlist:</p></label>
                        <input type="text" id="playlist" name="playlist" class="input-text" required>
                    </div>
                    
                    <input type="submit" value="Add Playlist" class="submit-button">

                </form>
        </div>
    </div>
</body>
</html>