<?php

/* Acció i controlador per defecte */
define('CONTROLADOR_DEFECTO', "personas");
define('ACCION_DEFECTO', "listado");

function cargarControlador($controller){
  $controlador = $controller.'_controller';
  $strFileController='controllers/'.$controlador.'.php';

  if(!is_file($strFileController)){
    $strFileController='/controller/'.CONTROLADOR_DEFECTO.'_controller.php';
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
