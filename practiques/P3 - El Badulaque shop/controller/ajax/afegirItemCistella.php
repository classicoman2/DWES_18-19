<?php

//Obtenir el directori base
$basedir = dirname(dirname(getcwd()));

require_once "{$basedir}/session_start.php";

//echo $basedir; exit;

  $id = $_GET['id'];
  $usuari = $_SESSION["myusername"];
  //Guardam cookie com array de nom: nom de l'usuari
  //    setcookie($usuari."[$id]",1,time()+3600);
  if (isset ($_SESSION['cistella']))
     $cistella = $_SESSION['cistella'];
  else
     $_SESSION['cistella'] = array();


  //Afegeix l'item
  $cistella[$id] = 1;
  $_SESSION['cistella'] = $cistella;

  //Inclou el bocí de la Pantalla amb la Cistella actualitzada
  include "{$basedir}/view/pantalla_sub_cistella.php";
?>
