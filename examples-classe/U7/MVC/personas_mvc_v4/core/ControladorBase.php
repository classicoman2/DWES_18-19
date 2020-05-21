<?php
class ControladorBase {

/*
* Este método para renderizar vistas recibe los datos del controlador en forma de array,
* los recorre y crea una variable dinámica con el indice asociativo y le da el
* valor que contiene dicha posición del array.
  Luego carga la vista que recibe como parámetro.
*/
  public function view($vista, $datos){

      //Crea les variables a partir de l'array associatiu que se li passa
      //al métode  view  en cridar-lo
      foreach ($datos as $id_assoc => $valor) {
          ${$id_assoc}=$valor;
      }

      //Inclou el codi de la vista
      require_once 'views/'.$vista;
  }
}
?>
