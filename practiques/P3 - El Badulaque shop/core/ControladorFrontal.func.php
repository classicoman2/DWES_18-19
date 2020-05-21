<?php

/* Acció i controlador per defecte */
define('CONTROLADOR_DEFECTO', "llibres");
define('ACCION_DEFECTO', "llista");

function cargarControlador($controller){
  $controlador = $controller.'_controller';
  $strFileController='controller/'.$controlador.'.php';

  //Si el controlador està mal escrit, 404
  if(!is_file($strFileController)){
/*    $strFileController='controller/'.CONTROLADOR_DEFECTO.'_controller.php';
    $controlador = CONTROLADOR_DEFECTO.'_controller';*/
        $controllerObj=cargarControlador( "llibres" );
        $controllerObj->view404();
        exit;
  }

  require_once $strFileController;
  $controllerObj=new $controlador();
  return $controllerObj;
}

/*
  A partir del nom del controlador i de l'acció, executa el mètode corresponent
  del Controlador que toca.
*/
function cargarAccion($controllerObj,$action){
  $accion=$action;
  $controllerObj->$accion();
}

function lanzarAccion($controllerObj){
  if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
      cargarAccion($controllerObj, $_GET["action"]);
  } else{
      cargarAccion($controllerObj, ACCION_DEFECTO);
  }
}

?>
