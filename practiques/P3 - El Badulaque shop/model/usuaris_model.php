<?php
require_once "core/model_base.php";

/* Torna la fila amb l'usuari o be  false  si no el troba */
class usuaris_model extends model_base {

  function __construct() {
      parent::__construct("usuaris");
  }


  /*
     Retorna la fila d'un usuari a partir del username
  */
  function getUser($username) {
      $sql = "SELECT * FROM usuaris WHERE nom='$username' ";
  	  $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {
          return $result->fetch_assoc();
      } else {
          return false;
      }
  }

  /*
     Retorna el ID d'un usuari a partir del username
  */
  function getUserId($username) {
      $sql = "SELECT * FROM usuaris WHERE nom='$username' ";
  	  $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {
          $fila = $result->fetch_assoc();
          return $fila['id'];
      } else {
          return false;
      }
  }

  function insert($nom, $password) {
    $hashed = crypt($password, "$1$123456789");  //MD5
    //*ref* https://www.w3schools.com/PHP/php_mysql_insert.asp
    $sql = "INSERT INTO usuaris (nom, password, tipus_usuari)
          VALUES ('$nom','$hashed','client')";  //xtoni  pdt acabar.

    if ($this->conn->query($sql) === TRUE) {
       return true;
    } else {
       die ("Error: " . $sql . "<br>" . $this->conn->error);
    }
  }

}
?>
