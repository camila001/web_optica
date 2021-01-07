<?php

namespace models;
require_once("Conexion.php");

class Receta{

    public function getMaterialCristal(){
        $stm = Conexion::conector()->prepare("SELECT * FROM material_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getArmazon(){
        $stm = Conexion::conector()->prepare("SELECT * FROM armazon");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTipoCristal(){
        $stm = Conexion::conector()->prepare("SELECT * FROM tipo_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertarReceta($data){
        $stm = Conexion::conector()->prepare("INSERT INTO receta values(NULL,:A,:B,:C,:D,:E,:F,:G,:H,:I,:J,:K,:L,:M,:N,:O,:P,:Q,:R,:S,:T,:U,:V,:W)");
        $stm->bindParam(":A", $data['tipo_lente']);
        $stm->bindParam(":B", $data['esfera_oi']);
        $stm->bindParam(":C", $data['esfera_od']);
        $stm->bindParam(":D", $data['cilindro_oi']);
        $stm->bindParam(":E", $data['cilindro_od']);
        $stm->bindParam(":F", $data['eje_oi']);
        $stm->bindParam(":G", $data['eje_od']);
        $stm->bindParam(":H", $data['prisma']);
        $stm->bindParam(":I", $data['base']);
        $stm->bindParam(":J", $data['armazon']);
        $stm->bindParam(":K", $data['material_cristal']);
        $stm->bindParam(":L", $data['tipo_cristal']);
        $stm->bindParam(":M", $data['distancia_pupilar']);
        $stm->bindParam(":N", $data['valor_lente']);
        $stm->bindParam(":O", $data['fecha_entrega']);
        $stm->bindParam(":P", $data['fecha_retiro']);
        $stm->bindParam(":Q", $data['observacion']);
        $stm->bindParam(":R", $data['rut_cliente']);
        $stm->bindParam(":S", $data['fecha_visita_medico']);
        $stm->bindParam(":T", $data['rut_medico']);
        $stm->bindParam(":U", $data['nombre_medico']);
        $stm->bindParam(":V", $data['rut_usuario']);
        $stm->bindParam(":W", $data['estado']);
        return $stm->execute();
    }

    public function buscarxRut($rut){
        $sql = ' SELECT id_receta "id", tipo_lente, esfera_oi, esfera_od, cilindro_oi, cilindro_od, eje_oi, ';
        $sql.= ' eje_od, prisma, base, ar.nombre_armazon "armazon", mt.material_cristal, tc.tipo_cristal, ';
        $sql.= ' distancia_pupilar, valor_lente "precio", fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql.= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", receta.estado FROM receta ';
        $sql.= ' INNER JOIN material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql.= ' inner join armazon ar on ar.id_armazon=receta.armazon '; 
        $sql.= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql.= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql.= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql.= ' where receta.rut_cliente = :A';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarxFecha($fecha){
        $sql = ' SELECT id_receta "id", tipo_lente, esfera_oi, esfera_od, cilindro_oi, cilindro_od, eje_oi, ';
        $sql.= ' eje_od, prisma, base, ar.nombre_armazon "armazon", mt.material_cristal, tc.tipo_cristal, ';
        $sql.= ' distancia_pupilar, valor_lente "precio", fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql.= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", receta.estado FROM receta ';
        $sql.= ' INNER JOIN material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql.= ' inner join armazon ar on ar.id_armazon=receta.armazon '; 
        $sql.= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql.= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql.= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql.= ' where receta.fecha_entrega =:A';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(':A', $fecha);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarxId($id){
        $sql = ' SELECT id_receta "id", tipo_lente, esfera_oi, esfera_od, cilindro_oi, cilindro_od, eje_oi, ';
        $sql.= ' eje_od, prisma, base, ar.nombre_armazon "armazon", mt.material_cristal, tc.tipo_cristal, ';
        $sql.= ' distancia_pupilar, valor_lente "precio", fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql.= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", receta.estado FROM receta ';
        $sql.= ' INNER JOIN material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql.= ' inner join armazon ar on ar.id_armazon=receta.armazon '; 
        $sql.= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql.= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql.= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql.= ' where receta.id_receta =:A';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(':A', $id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }


}