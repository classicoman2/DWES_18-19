<?php
require_once "core/model_base.php";

class llibres_model extends model_base {
  private $id;
  private $titol;
  private $autor;
  private $genere;
  private $data_entrada;
  private $preu;
  private $imatge;

  function __construct() {
      parent::__construct("llibres");
  }

  function getId() {
      return $this->id;
  }

  function setId($id) {
      $this->id = $id;
  }

  function getTitol() {
    return $this->titol;
  }

  function setTitol($titol) {
    $this->titol = $titol;
  }

  function getAutor() {
    return $this->autor;
  }

  function setAutor($autor) {
    $this->autor = $autor;
  }

  function getGenere() {
    return $this->genere;
  }

  function setGenere($genere) {
    $this->genere = $genere;
  }

  function getData_entrada() {
    return $this->data_entrada;
  }

  function setData_entrada($data_entrada) {
    $this->data_entrada = $data_entrada;
  }

  function getPreu() {
    return $this->preu;
  }

  function setPreu($preu) {
    $this->preu = $preu;
  }

  function getImatge() {
    return $this->imatge;
  }

  function setImatge($imatge) {
    $this->imatge = $imatge;
  }


  function insert() {
  	$sql = "INSERT INTO llibres (titol,autor,data_entrada,genere,preu,imatge) ".
           "VALUES ('{$this->titol}','{$this->autor}','{$this->data_entrada}',".
          "'{$this->genere}','{$this->preu}','{$this->imatge}')";  //xtoni  pdt acabar.

  	if ($this->conn->query($sql) === TRUE) {
     	 return false;
  	} else {
  	   return ("Error: " . $sql . "<br>" . $this->conn->error);
  	}
  }

/**
 * [update description]
 * @return boolean [description]
 */
function update() {
  //Si l'usuari ha seleccionat una nova imatge, l'he de carregar en el UPDATE
  $camp_imatge="";
  if (!empty( $this->imatge ))
     $camp_imatge=" ,imatge='{$this->imatge}'";

  $sql = "UPDATE llibres SET ".
         "titol='{$this->titol}', autor='{$this->autor}',".
         " data_entrada='{$this->data_entrada}', preu='{$this->preu}',".
         " genere='{$this->genere}'".
         " $camp_imatge WHERE id={$this->id}";
  if ($this->conn->query($sql) === TRUE)
    return false;  //No hi ha hagut error
  else
    return "Error: " . $sql . "<br>" . $this->conn->error;
}

/**
 * [getLlibreByCleanurl description]
 * @param  string $cleanurl La clean url del llibre
 * @return FALSE si hi no ha trobat cap registre, el registre si ho ha trobat.
 */
function getLlibreByCleanurl($cleanurl) {
   //Query
   $sql = "SELECT * FROM llibres WHERE cleanurl='$cleanurl'";
   $result =  $this->conn->query($sql);

   if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     return $row;
   } else {
     return FALSE;  //Hi ha hagut un error
   }
  }
}
?>
