<?php

namespace models;

use PDO;
use PDOException;

class Conexion{
    public static $user="root";
    public static $pass="";
    public static $URL="mysql:host=localhost;dbname=optica_2020";

    public static function conector(){
        try{
            return new \PDO(Conexion::$URL,Conexion::$user,Conexion::$pass);
        }catch(PDOException $e){
            return null;
        }
    }

}