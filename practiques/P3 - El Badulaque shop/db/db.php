<?php
class Connectar{
    //ovhovhovh remot
    /*
    public static function connexio(){
        $conexion=new mysqli("toniamenlptoni.mysql.db", "toniamenlptoni", "Asdfg123", "toniamenlptoni");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
    */

     public static function connexio(){
       if ($_SERVER['SERVER_NAME']!=="localhost") {
         /* Connexió a servidor remot OVH, ara caducada  xtoni 24-12-2018 */
         $conexion=new mysqli("toniamenlptoni.mysql.db", "toniamenlptoni", "Asdfg123", "toniamenlptoni");
         $conexion->query("SET NAMES 'utf8'");
         return $conexion;
      } else {
        $conexion=new mysqli("localhost", "root", "", "biblio_mvc_database");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
      }
    }
}


/*

class Connectar{

  public static function connexio(){

    if ($_SERVER['SERVER_NAME']=="localhost") {
      $conexion=new mysqli("toniamenlptoni.mysql.db", "toniamenlptoni", "Asdfg123", "toniamenlptoni");
    } else {
      $conexion=new mysqli("localhost", "user", "user", "biblioteca");
    }

    $conexion->query("SET NAMES 'utf8'");
    return $conexion;
  }

}

 */
