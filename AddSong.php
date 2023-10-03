<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Add Song</title>
</head>
<body>
    <div class="container">

        <div class="container-card">

            <h1>ADD SONG</h1>

            <form action="processAddSong.php" method="post" enctype="multipart/form-data" class="form">

                <div class="label-input">
                    <label for="title"><p>TITLE:</p></label>
                    <input type="text" id="title" name="title" placeholder="Title of song." class="input-text" required>
                </div>
                <div class="label-input">
                    <label for="artist"><p>ARTIST:</p></label>
                    <input type="text" id="artist" name="artist" placeholder="Artist of song." class="input-text" required>
                </div>

                <div class="label-input">
                    <label for="audio_url"><p>SONG:</p></label>
                    <input type="file" id="audio_url" name="audio_url" accept=".mp3" class="input-file" required>
                </div>

                <div class="label-input">
                    <label for="cover_url"><p>COVER:</p></label>
                    <input type="file" id="cover_url" name="cover_url" accept="image/*" placeholder="Cover" class="input-file" required>
                </div>

                <div class="label-input">
                    <label for="playlist"><p>PLAYLIST:</p></label>
                    <select name="selected_playlist" id="playlist">
                        <?php
                            $playlist_files = glob('playlist/*.json');
                            foreach ($playlist_files as $playlist_file) {
                                $playlist_name = strtoupper(pathinfo($playlist_file, PATHINFO_FILENAME));
                                echo "<option value='$playlist_file'>$playlist_name</option>";
                            }
                        ?>
                    </select>
                </div>

                <input type="submit" value="Add Song" class="submit-button">

            </form>

        </div>

    </div>

</body>
</html>