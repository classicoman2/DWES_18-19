<?php
//Estableixo l'inici de la sessió, que expira per defecte en 60 segons.
//https://stackoverflow.com/questions/9797913/how-do-i-create-persistent-sessions-in-php



/*

ini_set('session.cookie_lifetime', 3600*24);  //1 dia
ini_set('session.gc_maxlifetime', 3600*24);

//Codi per incloure la inclusio d'aquest fitxer des de AJAX

if ( file_exists ( 'sessions') ) {
   $ruta = "sessions";
} else {
  //Cridada des de controller/ajax/nomfitxerajax.php
  $ruta = dirname(dirname(getcwd()))."/sessions";
}

ini_set('session.save_path', $ruta);

*/



session_start();
