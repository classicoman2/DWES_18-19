<?php
require_once "core/model_base.php";

class compres_model extends model_base {
  private $id;
  private $id_client;
  private $data_compra;

  function __construct() {
      parent::__construct("compres");
  }

  function getId() {
      return $this->id;
  }

  function setId($id) {
      $this->id = $id;
  }

  function getIdClient() {
    return $this->id_client;
  }

  function setIdClient($id_client) {
    $this->id_client = $id_client;
  }

  function getDataCompra() {
    return $this->data_compra;
  }

  function setDataCompra($data_compra) {
    $this->data_compra = $data_compra;
  }


  function insert() {
  	$sql = "INSERT INTO compres (id_client,data_compra)
  			  VALUES ('{$this->id_client}','{$this->data_compra}')";

  	if ($this->conn->query($sql) === TRUE) {
     	 return TRUE;
  	} else {
  	   return ("Error: " . $sql . "<br>" . $this->conn->error);
  	}
  }


 function getCompres_de_client($id_client) {
   $sql = "SELECT * FROM compres WHERE id_client='$id_client' ";
   $result =  $this->conn->query($sql);

   //Torna un Array
   $compres = array();
   while ($row = $result->fetch_assoc()) {
       $compres[] = $row;
   }

   return $compres;
  }

}
?>
