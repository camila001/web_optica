<?php

namespace controllers;

use models\Receta as Receta;

require_once("../models/Receta.php");

class GetMaterialCristal{

    public function getMateriales(){
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol']=="vendedor"){
                $modelo=new Receta();
                $arr = $modelo->getMaterialCristal();
                echo json_encode($arr);
            }else{
                echo json_encode(["msg" => "Acceso denegado"]);
            }
        }else{
            echo json_encode(["msg" => "Acceso denegado"]);
        }
    }

}
$obj = new GetMaterialCristal();
$obj->getMateriales();