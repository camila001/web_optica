<?php

namespace models;

use PDO;
use PDOException;

class Conexion{
    public static $user="u5gwydksqdhdrrmy";
    public static $pass="idA8cdeiY2hzNH2RfWF0";
    public static $URL="mysql:host=bnj0ngnc1tzsdhcupvn8-mysql.services.clever-cloud.com;dbname=bnj0ngnc1tzsdhcupvn8";

    public static function conector(){
        try{
            return new \PDO(Conexion::$URL,Conexion::$user,Conexion::$pass);
        }catch(PDOException $e){
            return null;
        }
    }

}