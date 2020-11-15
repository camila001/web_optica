<?php

namespace controllers;

require("../models/Usuario.php");

use models\Usuario as Usuario;

class NewUser{
    private $nombre;
    private $rut;

    public function __construct()
    {
        $this->nombre = $_POST['name'];
        $this->rut = $_POST['rut'];
    }

    public function añadir(){
        session_start();
        if($this->nombre=="" || $this->rut==""){
            $_SESSION['error']="Complete los campos";
            header("Location: ../view/admin.php");
            return;
        }

        $model = new Usuario();
        $data = ['rut'=>$this->rut, 'nombre'=>$this->nombre, 'rol'=>"vendedor", 'clave'=>123456,'estado'=>1];
        $count = $model->crearUsuario($data);

        if($count==1){
            $_SESSION['resp'] = "Usuario creado!";
        }else{
            $_SESSION['error'] = "Error en la base de datos :(";
        }
        header("Location: ../view/admin.php");
    }

}
$obj= new NewUser();
$obj->añadir();