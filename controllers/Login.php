<?php

namespace controllers;

require_once("../models/Usuario.php");
use models\Usuario as Usuario;

class Login{
    private $rut;
    private $clave;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
        $this->clave = $_POST['pass'];
    }

    public function login(){
        session_start();
        if($this->rut=="" || $this->clave==""){
            $_SESSION['error']="Complete los campos";
            header("Location: ../index.php");
            return;
        }

        $modelo = new Usuario();
        $array = $modelo->iniciarSesion($this->rut, $this->clave);
        //print_r($array);
        
        if(count($array)==0){
            $_SESSION['error'] = "Usuario no encontrado";
            header("Location: ../index.php");
            return;
        }

        $_SESSION['user'] = $array[0];

        if($_SESSION['user']['estado']==1){
            if($_SESSION['user']['rol']=="administrador"){
                header("Location: ../view/admin.php");
            }else{
                header("Location: ../view/user.php");
            }
        }else{
            $_SESSION['error']="Usuario no habilitado";
            header("Location: ../index.php");
            return;
        }
        
    }

}
$obj = new Login();
$obj->login();