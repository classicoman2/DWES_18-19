<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "user", "user", "personas_mvc");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
