<?php

namespace controllers;

require("../models/Cliente.php");

use models\Cliente as Cliente;

class NewClient{
    public $rut;
    public $nombre;
    public $direccion;
    public $telefono;
    public $fecha;
    public $email;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
        $this->nombre = $_POST['name'];
        $this->direccion = $_POST['direccion'];
        $this->telefono = $_POST['telefono'];
        $this->fecha = $_POST['fecha'];
        $this->email = $_POST['email'];
    }

    public function newClient(){
        session_start();
        if($this->rut=="" || $this->nombre=="" || $this->direccion=="" || $this->telefono=="" || $this->fecha=="" || $this->email==""){
            $_SESSION['c_error']="Complete los campos";
            header("Location: ../view/user.php");
            return;
        }

        $model = new Cliente();
        $data = [
            'rut_cliente'=>$this->rut,
            'nombre_cliente'=>$this->nombre,
            'direccion_cliente'=>$this->direccion,
            'telefono_cliente'=>$this->telefono,
            'fecha_creacion'=>$this->fecha,
            'email_cliente'=>$this->email
        ];
        //print_r($data);
        $count = $model->insertarCliente($data);

        if($count==1){
            $_SESSION['c_resp'] = "Cliente añadido";
        }else{
            $_SESSION['c_error'] = "Error en la BD";
        }
        header("Location: ../view/user.php");
    }

}
$obj = new NewClient();
$obj->newClient();