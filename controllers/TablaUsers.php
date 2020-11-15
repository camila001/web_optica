<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");

class TablaUsers{
    public $bt_edit;

    public function __construct()
    {
        $this->bt_edit = $_POST['bt_edit'];
    }

    public function editar(){
        session_start();
        $_SESSION['editar'] = "ON";
        $modelo = new Usuario;
        $vendedor = $modelo->buscarUser($this->bt_edit);
        $_SESSION['vendedor'] = $vendedor[0];
        header("Location: ../view/admin.php");
    }

}
$obj = new TablaUsers();
$obj->editar();