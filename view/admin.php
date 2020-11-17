<?php
    use models\Usuario as Usuario;
    session_start();
    require_once("../models/Usuario.php");
    $model = new Usuario();
    $rol="vendedor";
    $usuarios = $model->getVendedores($rol);
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
        <?php if($_SESSION['user']['rol']=="administrador"){ ?>

            <nav class="deep-orange accent-4">
                <div class="nav-wrapper">
                <a href="#" class="brand-logo" style="margin-left: 20px;"><i class="material-icons" style="font-size: 40px;">admin_panel_settings</i>Admin</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 20px; font-family:'Raleway', sans-serif;">
                    <li><a href="salir.php"><i class="material-icons" style="font-size: 40px;">exit_to_app</i></a></li>
                </ul>
                </div>
            </nav>

            <div class="card-panel" style="width:1200px; margin:0 auto; margin-top:20px; border-radius:10px; align-content:center; background: rgba(255, 255, 255, 0.8)">
                <div class="row">
                    <div class="col l4 m4 s12">
                        <?php if(!isset($_SESSION['editar'])){ ?>
                            <h4>Añadir usuario</h4>
                            <br>
                            <form action="../controllers/NewUser.php" method="POST">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="u" type="text" name="rut">
                                    <label for="u">Rut</label>
                                </div> 
                                <div class="input-field">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="d" type="text" name="name">
                                    <label for="d">Nombre</label>
                                </div> 
                                <button class="waves-effect waves-light btn ancho-100 deep-orange" style="font-family: 'Coustard', serif;">Crear usuario</button>
                            </form>

                            <p class="green-text center">
                                <?php 
                                    if(isset($_SESSION['resp'])){
                                        echo $_SESSION['resp'];
                                        unset($_SESSION['resp']);
                                    }
                                ?>
                            </p>
                            <p class="red-text center">
                                <?php 
                                    if(isset($_SESSION['error'])){
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    }
                                ?>
                            </p>

                        <?php }else{?>
                            <h4>Editar estado</h4>
                            <br>
                            <form action="../controllers/EditUser.php" method="POST">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input disabled value="<?= $_SESSION['vendedor']['rut'] ?>" id="disabled" type="text">
                                    <label for="disabled">Rut</label>
                                </div> 
                                <input type="hidden" name="rut" value="<?= $_SESSION['vendedor']['rut']?>"> 
                                <div class="input-field">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input disabled value="<?= $_SESSION['vendedor']['nombre'] ?>" id="disabled" type="text">
                                    <label for="disabled">Nombre</label>
                                </div> 
                                <div class="input-field">
                                    <i class="material-icons prefix">block</i>
                                    <select name="estado" id="estado">
                                        <option value="1">Habilitado</option>
                                        <option value="0">Bloqueado</option>
                                    </select>
                                    <label>Estado</label>
                                </div>

                                <br>
                                <button class="waves-effect waves-light btn ancho-100 deep-orange" style="font-family: 'Coustard', serif;">Editar usuario</button>
                            </form>
                        
                        <?php
                                unset($_SESSION['editar']);
                                unset($_SESSION['vendedor']); 
                            } 
                        ?>
                        <p class="green-text center">
                            <?php 
                                if(isset($_SESSION['editado'])){
                                    echo $_SESSION['editado'];
                                    unset($_SESSION['editado']);
                                }
                            ?>
                        </p>
                        <p class="red-text center">
                            <?php 
                                if(isset($_SESSION['e_error'])){
                                    echo $_SESSION['e_error'];
                                    unset($_SESSION['e_error']);
                                }
                            ?>
                        </p>
                    </div>
                
                    <div class="col l8 m8 s12">
                        <form action="../controllers/TablaUsers.php" method="POST">
                            <table>
                                <tr>
                                    <td>Rut</td>
                                    <td>Nombre</td>
                                    <td>Estado</td>
                                    <td>Acciones</td>
                                </tr> 
                                <?php foreach($usuarios as $item){ ?>
                                    <?php if($item['estado']==0){ ?>
                                        <tr class="red-text">                                   
                                            <td><?=$item['rut']; ?></td>
                                            <td><?=$item['nombre']; ?></td>
                                            <td><?php if($item['estado']==1){
                                                    echo "Habilitado";
                                                }else{
                                                    echo "Deshabilitado";
                                                } ?>
                                            </td>
                                            <td><button name="bt_edit" value="<?= $item["rut"]?>" class="btn-floating waves-effect waves-light deep-orange"><i class="material-icons">edit</i></button></td>
                                        </tr>
                                    <?php }else{ ?>
                                        <tr>                                   
                                            <td><?=$item['rut']; ?></td>
                                            <td><?=$item['nombre']; ?></td>
                                            <td><?php if($item['estado']==1){
                                                    echo "Habilitado";
                                                }else{
                                                    echo "Bloqueado";
                                                } ?>
                                            </td>
                                            <td><button name="bt_edit" value="<?= $item["rut"]?>" class="btn-floating waves-effect waves-light deep-orange"><i class="material-icons">edit</i></button></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        <?php }else { ?>
            <div class="card-panel" style="width:400px; margin:0 auto; margin-top:20px; border-radius:10px; background: rgba(255, 255, 255, 0.8)">
            <h4 class="center" style="color:#ef5350;">Error de acceso</h4>
            <p class="center">Debes ser administrador para ingresar</p>
            <div style="display: flex; justify-content: space-between;">
                <p>
                    <a href="../view/user.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">arrow_back</i></a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>
</html>