<?php

namespace models;
require_once("Conexion.php");

class Cliente{

    public function insertarCliente($data){
        $stm = Conexion::conector()->prepare("INSERT INTO cliente VALUES(:A,:B,:C,:D,:E,:F)");
        $stm->bindParam(":A",$data['rut_cliente']);
        $stm->bindParam(":B",$data['nombre_cliente']);
        $stm->bindParam(":C",$data['direccion_cliente']);
        $stm->bindParam(":D",$data['telefono_cliente']);
        $stm->bindParam(":E",$data['fecha_creacion']);
        $stm->bindParam(":F",$data['email_cliente']);
        return $stm->execute();
    }

    public function buscarClienteRut($rut){
        $stm = Conexion::conector()->prepare("SELECT * FROM cliente WHERE rut_cliente=:A");
        $stm->bindParam(":A",$rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

}