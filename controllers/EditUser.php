<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");

class EditUser{
    public $rut;
    public $estado;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
        $this->estado = $_POST['estado'];
    }

    public function editarEstado(){
        session_start();
        $modelo = new Usuario();
        $count = $modelo->editEstado($this->estado, $this->rut);
        if($count==1){
            $_SESSION['editado']="Usuario actualizado";
        }else{
            $_SESSION['e_error']="Error en la BD";
        }
        header("Location: ../view/admin.php");
    }
}
$obj = new EditUser();
$obj->editarEstado();