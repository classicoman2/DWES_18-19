<?php
class ControladorBase{

/*
* Este método para renderizar vistas recibe los datos del controlador en forma de array,
* los recorre y crea una variable dinámica con el indice asociativo y le da el
* valor que contiene dicha posición del array.
  Luego carga los helpers para las vistas y carga la vista que recibe como parámetro.
*/
    public function view($vista, $datos){

        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }

        //Ajudant per les vistes
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();

        require_once 'view/'.$vista;
    }


    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
}

