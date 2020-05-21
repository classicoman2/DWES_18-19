<?php
class model_base {

  protected $conn;
  protected $table;


  protected function __construct($taula) {
      //El constructor crea un objecte BDD i s'hi connecta.
      $this->table = $taula;
      $this->conn =  Connectar::connexio();
  }


  //funció per netejar els camps
  public function netejar_camps($data) {
      $data = trim($data);
      $data = stripslashes($data);
    //  $data = htmlspecialchars($data);
      $data = mysqli_real_escape_string($this->conn, $data);
      return $data;
  }


  public function getAll () {
  	$result = $this->conn->query("SELECT * FROM $this->table");
    $dades = array();
    while ($row = $result->fetch_assoc()) {
      $dades[] = $row;
    }
    return $dades;
  }


  public function getAllfilteredByFieldValue ($fieldname, $fieldvalue) {
  	$result = $this->conn->query("SELECT * FROM $this->table WHERE $fieldname='$fieldvalue'");
    $dades = array();
    while ($row = $result->fetch_assoc()) {
      $dades[] = $row;
    }
    return $dades;

  }

  public function getAllorderedByField ($field, $direction) {
  	$result = $this->conn->query("SELECT * FROM $this->table ORDER BY $field $direction");
    $dades = array();
    while ($row = $result->fetch_assoc()) {
      $dades[] = $row;
    }
    return $dades;

  }

  /*
    Li passam un id i ens torna un registre sencer en un Array
  */
  public function getById($id) {
        $sql = "SELECT * FROM $this->table WHERE id='$id'";
        $result =  $this->conn->query($sql);

        if ($result->num_rows > 0)
            return $result->fetch_assoc();
        else
            return false;
  }


  public function delete($id) {
    $sql = "DELETE FROM $this->table WHERE id='$id'";

    if ($this->conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $this->conn->error;
    }
  }


  function getLastId() {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $fila =  $result->fetch_assoc();
      return $fila['id'];
    } else {
        return "Error: " . $sql . "<br>" . $this->conn->error;
    }

  }
}

