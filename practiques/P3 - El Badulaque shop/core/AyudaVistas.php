<?php
class AyudaVistas {

private $config;

function __construct() {
  $this->config = include 'config/global.php';
}

/**
 * Creador de urls
 * @param  string $controlador Indica el fitxer de classe dins de /controller
 * @param  string $accion      Indica la funció dins de la classe
 * @return string              La url que necessitam
 */
public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
  $urlString="index.php?controller=".$controlador."&action=".$accion;
  return $urlString;
}

/**
 * Diu si ha d'emprar o no clean urls
 * @return string
 */
public function clean_urls() {
  return $this->config['clean_urls'];
}

/**
 * Dóna un directori local o l'adreça del domini virtual que
 *  haguem creat en Apache.
 * @return string
 */
public function directori() {
  return $this->config['directori_arrel'];
}

    /**
     * [titolweb description]
     * @return  string [description]
     */
public function titolweb() {
  return $this->config["titolweb"];
}

    /**
     * [numcols description]
     * @return  string [description]
     */
public function numcols() {
  return $this->config["numcols"];
}

/**
 * Per saber la implementació de la cistella de compra
 * @return  string  "session" si empro $_SESSION,  "cookie" si empro cookies
 */
public function tipus_cistella() {
  return $this->config("tipus_cistella");
}
}
?>
