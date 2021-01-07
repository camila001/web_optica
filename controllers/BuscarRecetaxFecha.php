<?php

namespace controllers;

use models\Receta as Receta;

require_once("../models/Receta.php");

class BuscarRecetaxFecha{
    public $fecha;

    public function __construct()
    {
        $this->fecha = $_POST['fecha'];
    }

    public function frecetas(){
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol']=="vendedor"){
                $modelo = new Receta();
                $arr = $modelo->buscarxFecha($this->fecha);
                echo json_encode($arr);
            }else{
                echo json_encode(["msg"=>"Acceso denegado"]);
            }
        }else{
            echo json_encode(["msg"=>"Acceso denegado"]);
        }
    }
}
$obj = new BuscarRecetaxFecha();
$obj->frecetas();