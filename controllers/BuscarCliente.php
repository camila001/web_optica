<?php

namespace controllers;

use models\Cliente as Cliente;

require_once("../models/Cliente.php");

class BuscarCliente{
    public $rut;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
    }

    public function buscarCliente(){
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol']=="vendedor"){
                $modelo = new Cliente();
                $arr = $modelo->buscarClienteRut($this->rut);

                if(count($arr)==1){
                    echo json_encode($arr[0]);
                    $_SESSION['cliente'] = $arr[0];
                }else{
                    echo json_encode(null);
                }
            }else{
                echo json_encode(['msg'=>'debes ser vendedor']);
            }
        }else{
            echo json_encode(['msg'=>'acceso denegado']);
        }
        

    }

}
$obj = new BuscarCliente();
$obj->buscarCliente();