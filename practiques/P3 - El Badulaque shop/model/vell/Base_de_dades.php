<?php

class Base_de_dades {

  //Dades de la connexió a la Base de Dades
	private $servername,  $usernameBDD, $passwordBDD, $basedades, $conn;

  function __construct() {
      $this->servername = "localhost";
  	  $this->usernameBDD = "toni";
  	  $this->passwordBDD = "toni";
  	  $this->basedades = "biblioteca";
      //Inicialitzo connexio a buid
      $this->conn = "";
  }

  function connectar() {
    // Create connection
    //*ref* http://php.net/manual/es/mysqli.construct.php
    $this->conn = new mysqli($this->servername, $this->usernameBDD, $this->passwordBDD,  $this->basedades);

    // Check connection
    if ($this->conn->connect_error) {
        return false;
        //die("Connection failed: " . $conn->connect_error);
    }
    else
      return true;
  }



  function consultaLlibresBD () {
  	return $this->conn->query("SELECT * FROM llibres");
  }

  /*
		Obté els id de tots els productes.
	*/
	function consultaLlibresBD_id () {
		return $this->conn->query("SELECT id FROM llibres");
	}


	function consultaLlibre($id) {
  	return $this->conn->query("SELECT * FROM llibres WHERE id=$id");
  }


  function insert($titol,$autor) {
  	//*ref* https://www.w3schools.com/PHP/php_mysql_insert.asp
  	$sql = "INSERT INTO llibres (titol,autor,ISBN,comprat,data_entrada)
  			  VALUES ('$titol','$autor',12345,'Y','2017-07-17')";

  	if ($this->conn->query($sql) === TRUE) {
     	 return true;
  	} else {
  	   return "Error: " . $sql . "<br>" . $this->conn->error;
  	}
  }



	function update($id, $titol,$autor,$data_entrada) {
  	$sql = "UPDATE llibres SET titol='$titol', autor='$autor', data_entrada='$data_entrada'
		       WHERE id=$id";

  	if ($this->conn->query($sql) === TRUE) {
     	 return true;
  	} else {
  	   return "Error: " . $sql . "<br>" . $this->conn->error;
  	}
  }



  function update($id) {
  	$sql = "DELETE FROM llibres WHERE id='$id'";

  	if ($this->conn->query($sql) === TRUE) {
     	  return true;
  	} else {
  	    return "Error: " . $sql . "<br>" . $this->conn->error;
  	}
  }



  function consultaUsuari($username, $password) {
  	$sql = "SELECT * FROM usuaris
  	        WHERE nom='$username' AND password='$password'";
  	return  $this->conn->query($sql);
  }

	function getById($id) {
  	$sql = "SELECT * FROM llibres WHERE id='$id'";
  	$result =  $this->conn->query($sql);

		$row = $result->fetch_assoc();
		return $row;
  }

	function tancaBD () {
		//*ref* http://php.net/manual/es/mysqli.close.php
		return $this->conn->close();
	}

}
?>
