<?php

namespace controllers;

use models\Receta as Receta;

require_once("../models/Receta.php");

class InsertarReceta{
    public $tipo_lente;
    public $esfera_oi;
    public $esfera_od;
    public $cilindro_oi;
    public $cilindro_od;
    public $eje_oi;
    public $eje_od;
    public $prisma;
    public $base;
    public $armazon;
    public $material_cristal;
    public $tipo_cristal;
    public $distancia_pupilar;
    public $valor_lente;
    public $fecha_entrega;
    public $fecha_retiro;
    public $observacion;
    public $rut_cliente;
    public $fecha_visita_medico;
    public $rut_medico;
    public $nombre_medico;
    public $estado;

    public function __construct()
    {
        $this->tipo_lente = $_POST['tipo_lente'];
        $this->esfera_oi = $_POST['esfera_oi'];
        $this->esfera_od = $_POST['esfera_od'];
        $this->cilindro_oi = $_POST['cilindro_oi'];
        $this->cilindro_od = $_POST['cilindro_od'];
        $this->eje_oi = $_POST['eje_oi'];
        $this->eje_od = $_POST['eje_od'];
        $this->prisma = $_POST['prisma'];
        $this->base = $_POST['base'];
        $this->armazon = $_POST['armazon'];
        $this->material_cristal = $_POST['material_cristal'];
        $this->tipo_cristal = $_POST['tipo_cristal'];
        $this->distancia_pupilar = $_POST['distancia_pupilar'];
        $this->valor_lente = $_POST['valor_lente'];
        $this->fecha_entrega = $_POST['fecha_entrega'];
        $this->fecha_retiro = $_POST['fecha_retiro'];
        $this->observacion = $_POST['observacion'];
        $this->rut_cliente = $_POST['rut_cliente'];
        $this->fecha_visita_medico = $_POST['fecha_visita_medico'];
        $this->rut_medico = $_POST['rut_medico'];
        $this->nombre_medico = $_POST['nombre_medico'];
        $this->estado = $_POST['estado'];
    }

    public function insertar(){
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol']=="vendedor"){
                $rut_user = $_SESSION['user']['rut'];
                $data = [
                'tipo_lente'=>$this->tipo_lente,
                'esfera_oi'=>$this->esfera_oi,
                'esfera_od'=>$this->esfera_od,
                'cilindro_oi'=>$this->cilindro_oi,
                'cilindro_od'=>$this->cilindro_od,
                'eje_oi'=>$this->eje_oi,
                'eje_od'=>$this->eje_od,
                'prisma'=>$this->prisma,
                'base'=>$this->base,
                'armazon'=>$this->armazon,
                'material_cristal'=>$this->material_cristal,
                'tipo_cristal'=>$this->tipo_cristal,
                'distancia_pupilar'=>$this->distancia_pupilar,
                'valor_lente'=>$this->valor_lente,
                'fecha_entrega'=>$this->fecha_entrega,
                'fecha_retiro'=>$this->fecha_retiro,
                'observacion'=>$this->observacion,
                'rut_cliente'=>$this->rut_cliente,
                'fecha_visita_medico'=>$this->fecha_visita_medico,
                'rut_medico'=>$this->rut_medico,
                'nombre_medico'=>$this->nombre_medico,
                'rut_usuario'=>$rut_user,
                'estado'=>$this->estado,
                ];
                $modelo = new Receta();
                $count = $modelo->insertarReceta($data);
                if($count==1){
                    echo json_encode(["msg"=>"Añadio"]);
                }else{
                    echo json_encode(["msg"=>"no :c"]);
                }
            }else{
                echo json_encode(["msg"=>"Acceso denegado"]);
            }
        }else{
            echo json_encode(["msg"=>"Acceso denegado"]);
        }
    }
}
$obj = new InsertarReceta();
$obj->insertar();