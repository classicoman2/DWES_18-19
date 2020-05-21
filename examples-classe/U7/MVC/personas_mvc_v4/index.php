<?php
require_once("db/db.php");

//Funciones para el controlador frontal
//F//https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
include 'core/ControladorFrontal.func.php';

//L'empro pel generador de vistes   view()
include 'core/ControladorBase.php';


require_once("controllers/personas_controller.php");
require_once("controllers/coches_controller.php");



/**
 * CONTROLADOR FRONTAL
 */
if(isset($_GET["controller"])){
    $controllerObj=cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
} else {
    $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}


?>
