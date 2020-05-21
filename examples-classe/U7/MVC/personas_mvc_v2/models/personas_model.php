<?php
class personas_model{
    private $db;
    private $personas;


    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }


    public function get_personas(){
        $consulta=$this->db->query("select * from personas;");
        while($filas=$consulta->fetch_assoc()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function insertar($nombre, $edad) {
         $sql = "INSERT INTO personas (nombre, edad) VALUES ('$nombre','$edad')";
         $result = $this->db->query($sql);

         if ($this->db->error)
             return "$sql<br>{$this->db->error}";
         else {
             return false;
         }
    }


    public function delete($id) {
        $sql = "DELETE FROM personas WHERE id='$id'";

        $result = $this->db->query($sql);

        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return false;
        }
    }
}
?>
