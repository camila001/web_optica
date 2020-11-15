<?php

namespace models;
require_once("Conexion.php");

class Usuario{

    public function iniciarSesion($rut, $clave){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A AND clave=:B");
        $stm->bindParam(":A",$rut);
        $stm->bindParam(":B",md5($clave));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function crearUsuario($data){
        $stm = Conexion::conector()->prepare("INSERT INTO usuario VALUES(:A,:B,:C,:D,:E)");
        $stm->bindParam(":A",$data['rut']);
        $stm->bindParam(":B",$data['nombre']);
        $stm->bindParam(":C",$data['rol']);
        $stm->bindParam(":D",md5($data['clave']));
        $stm->bindParam(":E",$data['estado']);
        return $stm->execute();
    }

    public function getVendedores($rol){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rol=:A");
        $stm->bindParam(":A", $rol);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarUser($rut){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A");
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function editEstado($estado,$rut){
        $stm = Conexion::conector()->prepare("UPDATE usuario SET estado=:A WHERE rut=:B");
        $stm->bindParam(":A",$estado);
        $stm->bindParam(":B",$rut);
        return $stm->execute();
    }

}