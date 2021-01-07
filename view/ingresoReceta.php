<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva receta</title>
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
                    <a href="#" class="brand-logo" style="margin-left: 20px; font-family:'Raleway', sans-serif;"><i class="material-icons" style="font-size: 40px;">assignment_ind</i> <?= $_SESSION['user']['nombre'] ?></a>
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 20px;">
                        <li><a href="../view/user.php">Añadir cliente<i class="material-icons left">assignment_ind</i></a></li>
                        <li><a href="../view/buscarReceta.php">Buscar receta<i class="material-icons left">search</i></a></li>
                        <li><a href="../view/ingresoReceta.php">Receta<i class="material-icons left">playlist_add</i></a></li>
                        <li><a href="salir.php"><i class="material-icons" style="font-size: 40px;">exit_to_app</i></a></li>
                    </ul>
                </div>
            </nav>

            <ul id="slide-out" class="sidenav">
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img src="../img/paper.jpg">
                        </div>
                        <div style="display: flex;">
                            <a href="#user" class="white-text"><i class="material-icons white-text"  style="font-size: 40px;">assignment_ind</i></a>
                            <a href="#user" class="white-text" style="margin-left: 10px;"><?= $_SESSION['user']['nombre'] ?></a>
                        </div>
                    </div>
                </li>
                <li><a href="../view/user.php">Añadir cliente</a></li>
                <li><a href="../view/buscarReceta.php">Buscar receta</a></li>
                <li><a href="../view/ingresoReceta.php">Receta</a></li>
                <li><a href="salir.php"><i class="material-icons deep-orange-text" style="font-size: 40px;">exit_to_app</i></a></li>
            </ul>

            <div class="container" id="app" style="padding:20px; margin-top:20px; border-radius:10px; align-content:center; background: rgba(255, 255, 255, 0.8)">
                <div class="row">
                    <div class="col l4 m12 s12">
                        <form @submit.prevent="buscar">
                            <div class="input-field">
                                <input type="text" v-model="rut" id="r" required>
                                <label for="r">Rut</label>
                            </div>
                            <button class="btn-small deep-orange">Buscar</button>
                        </form>
                    </div>

                    <div class="col l8 m12 s12">
                        <table class="responsive-table" v-if="esta">
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Telefono</th>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>{{cliente.nombre_cliente}}</td>
                                <td>{{cliente.direccion_cliente}}</td>
                                <td>{{cliente.telefono_cliente}}</td>
                                <td>{{cliente.email_cliente}}</td>
                            </tr>
                        </table>

                    </div>
                </div>
                <br>
                <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">
                <form @submit.prevent="guardar" v-if="esta">
                    <div class="row">
                        <div class="col l3 m3 s12">
                            <br>
                            Tipo de lente
                            <br><br>
                            <label>
                                <input type="checkbox" class="filled-in checkbox-orange" value="cerca" v-model="tipoLente"/>
                                <span style="color: black;">Cerca</span>
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="checkbox" class="filled-in checkbox-orange" value="lejos" v-model="tipoLente"/>
                                <span style="color: black;">Lejos</span>
                            </label>
                            <br>
                            <br>
                            <div>
                                Material cristal
                                <select v-model="id_material_cristal" class="browser-default" required>
                                    <option v-for="m in materiales" :value="m.id_material_cristal">
                                        {{m.material_cristal}}
                                    </option>
                                </select>
                            </div>
                            <br>
                            <div>
                                Prisma
                                <select class="browser-default" v-model="prisma">
                                    <option value="no">No aplica</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <input id="i" type="number" v-model="distancia" min="40" max="75" required pattern="[0-9]{2,}">
                                <label for="i">Distancia pupilar</label>
                            </div>
                            
                        </div>

                        <div class="col l3 m3 s12">
                            <br>
                            <div>
                                Tipo de cristal
                                <select v-model="id_tipo_cristal" class="browser-default" required>
                                    <option v-for="t in tipoCristal" :value="t.id_tipo_cristal">
                                        {{t.tipo_cristal}}
                                    </option>
                                </select>
                            </div>
                            <br>
                            <div>
                                Armazon
                                <select v-model="id_armazon" class="browser-default" required>
                                    <option v-for="a in armazones" :value="a.id_armazon">
                                        {{a.nombre_armazon}}
                                    </option>
                                </select>
                            </div>
                            <br>
                            <div>
                                Base
                                <select class="browser-default" v-model="base">
                                    <option value="no">No aplica</option>
                                    <option value="superior">Superior</option>
                                    <option value="inferior">Inferior</option>
                                    <option value="exterior">Exterior</option>
                                    <option value="interior">Interior</option>
                                </select>
                            </div>
                        </div>

                        <div class="col l3 m3 s12">
                            <div>
                                <p>Ojo izquierdo</p>
                                <div class="input-field">
                                    <input id="s" type="text" v-model="esf_oi" required pattern="[+-]+[0-9].[0-9]{2,2}" title="Ejemplo +0.25, -0.25">
                                    <label for="s">Esfera</label>
                                </div>
                                <div class="input-field">
                                    <input id="c" type="text" v-model="cil_oi" required pattern="[+-]+[0-9].[0-9]{2,2}" title="Ejemplo +0.25, -0.25">
                                    <label for="c">Cilindro</label>
                                </div>
                                <div class="input-field">
                                    <input id="e" type="number" v-model="eje_oi" max="180" required pattern="[0-9]{1,3}" title="Numeros de 0 a 180">
                                    <label for="e">Eje</label>
                                </div>
                            </div>
                        </div>

                        <div class="col l3 m3 s12">
                            <div>
                                <p>Ojo derecho</p>
                                <div class="input-field">
                                    <input id="s1" type="text" v-model="esf_od" required pattern="[+-]+[0-9].[0-9]{2,2}" title="Ejemplo +0.25, -0.25">
                                    <label for="s1">Esfera</label>
                                </div>
                                <div class="input-field">
                                    <input id="c1" type="text" v-model="cil_od" required pattern="[+-]+[0-9].[0-9]{2,2}" title="Ejemplo +0.25, -0.25">
                                    <label for="c1">Cilindro</label>
                                </div>
                                <div class="input-field">
                                    <input id="e1" type="number" v-model="eje_od" max="180" required pattern="[0-9]{1,3}">
                                    <label for="e1">Eje</label>
                                </div>
                            </div>
                        </div>                   

                    </div>
                
                    <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">

                    <div class="row">
                        <div class="col l4 m4 s12">
                            <div class="input-field" style="width:250px;">
                                <input type="date" class="datepicker" id="f" name="fecha" v-model="fechaEntrega" required>
                                <label for="f">Fecha de entrega</label>
                            </div>
                            <div class="input-field" style="width:250px;">
                                <input type="date" class="datepicker" id="re" name="fecha" v-model="fechaRetiro">
                                <label for="re">Fecha de retiro</label>
                            </div>
                        </div>

                        <div class="col l4 m4 s12">
                            <div class="input-field">
                                <input id="rm" type="text" style="width:250px;" v-model="rut_medico" required>
                                <label for="rm">Rut médico</label>
                            </div>
                            <div class="input-field">
                                <input id="nombre" type="text" style="width:250px;" v-model="nombre_medico" maxlength="70" required>
                                <label for="nombre">Nombre médico</label>
                            </div>
                        </div>

                        <div class="col l4 m4 s12">
                            <div class="input-field" style="width:250px;">
                                <input type="date" class="datepicker" id="vm" name="fecha" v-model="fechaVisita">
                                <label for="vm">Fecha de visita al médico</label>
                            </div>
                            <div class="input-field">
                                <textarea id="textarea1" class="materialize-textarea" style="width:250px;" v-model="obs" 
                                    maxlength="1000">
                                </textarea>
                                <label for="textarea1">Observaciones</label>
                            </div>
                        </div>

                    </div>

                    <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">

                    <div class="row">
                        <div class="col l3 m3 s12 offset-l6">
                            <div class="input-field">
                                <input id="valor" type="number" v-model="precio" min="0" max="999999999" required pattern="[0-9]">
                                <label for="valor">Valor del lente</label>
                            </div>
                        </div>
                        <br>
                        <div class="col l3 m3 s12">
                            <button class="btn-small deep-orange">Crear receta</button>
                        </div>
                    </div>
                </form>

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

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                'format': 'yyyy-mm-dd',
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
            var elems = document.querySelectorAll('.dropdown-trigger');
            var elems = document.querySelectorAll('.tooltipped');
            var instances = M.Tooltip.init(elems);
        });
    </script>
    <script src="../js/buscarCliente.js"></script>
</body>
</html>