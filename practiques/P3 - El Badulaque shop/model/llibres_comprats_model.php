<?php
require_once "core/model_base.php";

class llibres_comprats_model extends model_base {
  private $id_compra;
  private $id_llibre;
  private $unitats;
  private $preu;

  function __construct() {
      parent::__construct("llibres_comprats");
  }

  function getIdCompra() {
    return $this->id_compra;
  }

  function setIdCompra($id_compra) {
    $this->id_compra = $id_compra;
  }

  function getIdLlibre() {
    return $this->id_llibre;
  }

  function setIdLlibre($id_llibre) {
    $this->id_llibre = $id_llibre;
  }

  function getUnitats() {
    return $this->unitats;
  }

  function setUnitats($unitats) {
    $this->unitats = $unitats;
  }

  function getPreu() {
    return $this->preu;
  }

  function setPreu($preu) {
    $this->preu = $preu;
  }


  public function insert() {
  	$sql = "INSERT INTO llibres_comprats (id_compra,id_llibre,unitats,preu)
  			  VALUES ('{$this->id_compra}','{$this->id_llibre}','{$this->unitats}','{$this->preu}')";

  	if ($this->conn->query($sql) === TRUE) {
     	 return false;
  	} else {
  	   return ("Error: " . $sql . "<br>" . $this->conn->error);
  	}
  }

/*
  Torna un array amb els llibres que es van comprar en aquesta Compra
*/
  public function getLlibres_compra( $id_compra ) {
    $sql = "SELECT * FROM llibres_comprats WHERE id_compra='$id_compra'";
    $result =  $this->conn->query($sql);

    //Torna un Array
    $productes = array();
    while ($row = $result->fetch_assoc()) {
        $productes[] = $row;
    }

    return $productes;
  }
}
?>
