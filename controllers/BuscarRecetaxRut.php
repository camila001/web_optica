<?php

namespace controllers;

use models\Receta as Receta;

require_once("../models/Receta.php");

class BuscarRecetaxRut{
    public $rut;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
    }

    public function recetas(){
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol']=="vendedor"){
                $modelo = new Receta();
                $arr = $modelo->buscarxRut($this->rut);
                echo json_encode($arr);
            }else{
                echo json_encode(["msg"=>"Acceso denegado"]);
            }
        }else{
            echo json_encode(["msg"=>"Acceso denegado"]);
        }
    }

}
$obj = new BuscarRecetaxRut();
$obj->recetas();