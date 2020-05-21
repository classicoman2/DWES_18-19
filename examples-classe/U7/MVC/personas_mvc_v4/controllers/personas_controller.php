<?php
//Llamada al modelo
require_once("models/personas_model.php");


class personas_controller extends ControladorBase {

/**
 * Muestra pantalla 'add'
 * @return No
 */
function add() {

  //Cargamos la vista
        $this->view("personas_add.phtml", array(
        ));
  //require_once("views/personas_add.phtml");
}


/**
 * Mostra llistat
 * @return No
 */
function listado() {
  $persona=new personas_model();

  //Uso metodo del modelo de personas
  $datos  = $persona->get_personas();
  $titulo = "Listado de Personas";

  $this->view("personas_listado.phtml",array(
              "datos"                 => $datos,
              "Listado de Personas"   => $titulo
      ));
  //require_once("views/personas_listado.phtml");
}


/**
 * Inserta a la taula
 * @return No
 */
function insert() {
    $persona=new personas_model();

    if (isset($_POST['insert'])) {
        $persona->setNombre( $_POST['nombre'] );
        $persona->setEdad( $_POST['edad'] );

        $error = $persona->insertar();

        if (!$error) {
            header( "Location: index.php");
        }
        else {
            echo $error;
        }
    }
}


/**
 * Elimina una fila de la taula
 * @return No
 */
function delete() {
  if (isset($_GET['id'])) {
    $persona=new personas_model();

    $id = $_GET['id'];

    $error = $persona->delete($id);

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
