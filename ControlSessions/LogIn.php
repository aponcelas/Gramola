<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Iniciar sessió</title>
</head>
<body>

    <!--Contenidor principal-->
    <div class="container">

        <!--Contenidor pel LogIn-->
        <div class="container-card">

            <!--Títol del LogIn-->
            <h1>INICI DE SESSIÓ</h1>
            
            <!--Formulari que processa el nom d'usuari-->
            <form method="post" class="form" action="processLogIn.php">

                <!--Contenidor per l'usuari-->
                <div class="label-input">
                    <label for=""><p>USUARI:</p></label>
                    <input type="text" id="user" name="user" placeholder="Usuari." class="input-text" required>
                </div>                
                
                <!--Input per iniciar sessió-->
                <input type="submit" value="Log In" class="submit-button">
            </form>
            
            <!--Contenidor per al reproductor de música-->
            <div class="personal-info">

                <!--Anar al reproductor de música-->
                <a href="../index.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
