<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Coustard&display=swap" rel="stylesheet"> 
    <link href="../css/style.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/background.jpg'); font-family: 'Coustard', serif;">
    <?php if(isset($_SESSION['user'])){ ?> 
        <?php if($_SESSION['user']['rol']=="vendedor"){ ?>
            <nav class="deep-orange accent-4">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo" style="margin-left: 20px;">Sesión iniciada como: <?= $_SESSION['user']['nombre'] ?></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 20px;">
                        <li><a href="../view/buscarReceta.php">Buscar receta</a></li>
                        <li><a href="../view/ingresoReceta.php">Ingreso</a></li>
                        <li><a href="salir.php"><i class="material-icons" style="font-size: 40px;">exit_to_app</i></a></li>
                    </ul>
                </div>
            </nav>

            <div class="card-panel" style="width:1200px; margin:0 auto; margin-top:20px; border-radius:10px; align-content:center; background: rgba(255, 255, 255, 0.8)">
                <p class="center">
                    <i class="material-icons" style="font-size: 80px;">handyman</i>
                </p>
                <h4 class="center">En construcción uwu</h4>
            </div>
        <?php }else{ ?>
            <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; background: rgba(255, 255, 255, 0.8)">
                <h4 class="center" style="color:#ef5350;">Error de acceso</h4>
                <p class="center">Debes ser vendedor para ingresar a esta página</p>
                <div style="display: flex; justify-content: space-between;">
                    <p>
                        <a href="../view/admin.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">arrow_back</i></a>
                    </p>
                    <p class="right">
                        <a href="salir.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">exit_to_app</i></a>
                    </p>
                </div>
            </div>
        <?php } ?>

    <?php }else{ ?>
        <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; background: rgba(255, 255, 255, 0.8)">
            <h4 class="center" style="color:#ef5350;">Error de acceso</h4>
            <p class="center">Debes iniciar sesión</p>
            <p class="center">
                <a href="../index.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">home</i></a>
            </p>
        </div>
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  
</body>
</html>