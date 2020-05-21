<?php
require_once("model/llibres_model.php");
require_once("model/usuaris_model.php");

require_once("model/compres_model.php");
require_once("model/llibres_comprats_model.php");

/**
 * Controlador de compres_controller
 * @author Toni Amengual tamengual@iessonferrer.net
 */
class compres_controller extends ControladorBase{


/**
* Crear una cookie amb nom=id del producte, valor=numero de items a comprar
*/
public function afegir() {
  $id = $_GET['id'];

  $usuari = $_SESSION["myusername"];
  //Guardam cookie com array de nom: nom de l'usuari
//    setcookie($usuari."[$id]",1,time()+3600);
  $cistella = $_SESSION['cistella'];

  //Afegeix unitats
  if (!isset( $_POST["unitats"]))
     $cistella[$id] = 1;
  else
     $cistella[$id] = $_POST["unitats"];

  //Afegeix l'item
  $_SESSION['cistella'] = $cistella;

  header("Location: index.php");
}


/**
* Processa la compra a petició del client
*/
public function checkout() {
  $llibres = new llibres_model();

  //Recull els productes seleccionats
  $cistella = array();
  $i=0;

  if ( isset ( $_SESSION['cistella'] /* $_COOKIE[ $_SESSION["myusername"] ] */  )) {
    /* Recull tots els productes i afegeix les unitats */
    foreach ($_SESSION['cistella'] /* $_COOKIE[ $_SESSION["myusername"] ] */  as $i => $valor) {
        $cistella[$i] = $llibres->getById($i);
        //Afegeixo el número d'unitats
        $cistella[$i]['unitats'] = $valor;
        //echo "<tr><td>$valor exemplars de $i</tr>";
        $i++;
    }

    //Cargamos la vista
    $this->view("pantalla_pedido.php", array(
        "productes" => $cistella
    ));

  } else {
      header("Location: index.php");
  }
}


/**
*   Guarda una compra i informa l'usuari de que s'ha realitzat amb èxit.
*/
public function save() {
  //Models que necessito
  $usuaris = new usuaris_model();
  $compres = new compres_model();
  $llibres_comprats = new llibres_comprats_model();

  //Mostra per pantalla els productes seleccionats
  $productes = unserialize($_GET['productes']);

  //Guarda la compra
  $compres->setIdClient( $usuaris->getUserId( $_SESSION['myusername'] ) );
  $compres->setDataCompra( date("Y-m-d") );
  $compres->insert();

  //Obtenir id de la compra que acabo de fer ara.
  $id = $compres->getLastId();

  //id_compra és igual per a totes les files que he d'introduir
  $llibres_comprats->setIdCompra( $id );
  //Guarda cadascun dels productes comprats

  foreach($productes as $p) {
    //setters
    $llibres_comprats->setIdLlibre( $p['id'] );
    $llibres_comprats->setUnitats( $p['unitats'] );
    $llibres_comprats->setPreu( $p['preu'] );
    //Guarda
    $error = $llibres_comprats->insert();
    if ( $error !== TRUE )
      echo $error;
    }

  //Carregar vista de confirmació de la compra
  $this->view("pantalla_compra_confirmada.php", array(
       "productes" => $productes
  ));

  //Esborra la cistella
  unset($_SESSION['cistella']);

  /*
  //Delete Cookies
  foreach ( $_COOKIE[ $_SESSION["myusername"] ] as $i => $valor) {
    setcookie("{$_SESSION["myusername"]}[$i]","", time() - 1);
  }
  */
}


/**
* Llista les compres realitzades per l'usuari actual
*/
public function llista() {
  //Models que necessito
  $usuaris = new usuaris_model();
  $llibres = new llibres_model();

  $compres = new compres_model();
  $llibres_comprats = new llibres_comprats_model();

  //Obtenir totes les compres del client
  $compres_del_client = $compres->getCompres_de_client( $usuaris->getUserId( $_SESSION['myusername'] ) );

  $productes = array();
  foreach ($compres_del_client as $c) {
     //echo "<h1>{$c['data_compra']}, {$c['id']}</h1>";

     //Obté els llibres d'aquesta compra
     $llibres_comps = $llibres_comprats->getLlibres_compra( $c['id'] );
     foreach ($llibres_comps as $ll) {
         //Afegeix al llistat a mostrar
         $fila = $ll;
         //Afegeix el id i la data de la compra
         $fila['id_compra'] = $c['id'];
         $fila['data_compra'] = $c['data_compra'];
         //Obtengo dades del llibre
         $llibre = $llibres->getById( $ll['id_llibre'] );
         $fila['titol'] = $llibre['titol'];
         $fila['autor'] = $llibre['autor'];

         $productes[] = $fila;
     }
  }

  //Cargamos la vista
  $this->view("pantalla_compres-usuari.php", array(
                "productes" => $productes
  ));
}

}
?>
