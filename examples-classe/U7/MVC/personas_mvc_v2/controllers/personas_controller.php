<?php
//Llamada al modelo
require_once("models/personas_model.php");

class personas_controller {

  /**
   * Muestra pantalla 'add'
   * @return No
   */
public function add() {
  require_once("views/personas_add.phtml");
}


/**
 * Muestra listado de personas
 * @return No
 */
function view() {
  $per=new personas_model();

  //Uso metodo del modelo de personas
  $datos=$per->get_personas();

  //Llamado a la vista: mostrar la pantalla
  require_once("views/personas_view.phtml");
}


/**
 * Inserta un registre a la taula 'personas'
 * @return No
 */
function insert() {
  $per=new personas_model();

  if (isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $edad   = $_POST['edad'];

    $error = $per->insertar($nombre, $edad);

    if (!$error) {
      header( "Location: index.php");
    } else {
      echo $error;
    }
  }
}


/**
 * Borra una fila de la taula
 * @return no
 */
function delete() {
  if (isset($_GET['id'])) {
    $per=new personas_model();

    $id = $_GET['id'];

    $error = $per->delete($id);

    if (!$error) {
      header( "Location: index.php");
    }
    else {
      echo $error;
    }
  }
}

}
?>
