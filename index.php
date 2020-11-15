<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="grey darken-4">
    <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; align-content:center;">
        <h3 class="center">:3</h3>    
        <br>
        <form action="controllers/Login.php" method="POST">
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate" name="rut">
                <label for="icon_prefix">Rut</label>
            </div> 
            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input id="icon" type="password" class="validate" name="pass">
                <label for="icon">Contraseña</label>
            </div>
            <p class="center">
                <button class="waves-effect waves-light btn ancho-100 deep-orange ancho-100">Iniciar sesión</button>
            </p>
        </form>
        <p class="red-text">
            <?php
                session_start();
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
        </p>
    </div>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>      
</body>
</html>