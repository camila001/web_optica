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
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="grey darken-4">
    <?php if(isset($_SESSION['user'])){ ?> 
        <?php if($_SESSION['user']['rol']=="vendedor"){ ?>
            <nav class="grey darken-2">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo" style="margin-left: 20px; font-family:'Raleway', sans-serif;">Sesión iniciada como: <?= $_SESSION['user']['nombre'] ?></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 20px; font-family:'Raleway', sans-serif;">
                        <li><a href="../view/user.php">Añadir cliente</a></li>
                        <li><a href="../view/buscarReceta.php">Buscar receta</a></li>
                        <li><a href="../view/ingresoReceta.php">Ingreso</a></li>
                        <li><a href="salir.php"><i class="material-icons" style="font-size: 40px;">exit_to_app</i></a></li>
                    </ul>
                </div>
            </nav>

            <div class="card-panel" style="width:1200px; margin:0 auto; margin-top:20px; border-radius:10px; align-content:center;">
                <div class="row">
                    <div class="col l4 m4 s12">
                        <form action="../controllers/NewClient.php" method="POST">
                            <h4>Nuevo cliente</h4>
                            <br>
                            <div class="input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="r" type="text" name="rut">
                                <label for="r">Rut</label>
                            </div> 
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="n" type="text" name="name">
                                <label for="n">Nombre</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">home</i>
                                <input id="d" type="text" name="direccion">
                                <label for="d">Dirección</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">phone</i>
                                <input id="t" type="text" name="telefono">
                                <label for="t">Telefono</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" class="datepicker" id="f" name="fecha">
                                <label for="f">Fecha</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                <input id="e" type="text" name="email">
                                <label for="e">Email</label>
                            </div> 
                            <button class="waves-effect waves-light btn ancho-100 deep-orange">Añadir</button>
                        </form>

                        <p class="green-text">
                            <?php
                                if(isset($_SESSION['c_resp'])){
                                    echo $_SESSION['c_resp'];
                                    unset($_SESSION['c_resp']);
                                }
                            ?>
                        </p>
                        <p class="red-text">
                            <?php
                                if(isset($_SESSION['c_error'])){
                                    echo $_SESSION['c_error'];
                                    unset($_SESSION['c_error']);
                                }
                            ?>
                        </p>
                    </div>
                    <div class="col l8 m8 s12">

                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; font-family:'Raleway', sans-serif;">
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
        <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; font-family:'Raleway', sans-serif;">
            <h4 class="center" style="color:#ef5350;">Error de acceso</h4>
            <p class="center">Debes iniciar sesión</p>
            <p class="center">
                <a href="../index.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">home</i></a>
            </p>
        </div>
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                'format': 'yyyy/mm/dd',
                'i18n': {
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                    weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
                    cancel: 'Cancelar',
                    clear: 'Limpar',
                    done: 'Ok'
                }
            });
        });
    </script>

</body>
</html>