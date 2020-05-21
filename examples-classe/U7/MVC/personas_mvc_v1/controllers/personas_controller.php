<?php
//Llamada al modelo
require_once("models/personas_model.php");
$per=new personas_model();

//Uso metodo del modelo de personas
$datos=$per->get_personas();

//Llamado a la vista: mostrar la pantalla
require_once("views/personas_view.phtml");
?>
