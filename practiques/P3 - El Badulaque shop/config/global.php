<?php

if ($_SERVER['SERVER_NAME']=="localhost")
  $arrel = "";
else
  $arrel = "http://toniamensal.ovh/DWES/PRACTICA3/";


return array(
  "titolweb"        => "Llibreria SON FERRER",
  "directori_arrel" => $arrel,
  "numcols" => 4,          //Num de columnes en
  "tipus_cistella" => "session",  //"cookies"
  "clean_urls" => 0  //posar 1 si empro redireccio de clean urls
);
/*
//ovhovhovh
return array(
  "titolweb"        => "Llibreria SON FERRER 2018",
  "directori_arrel" => "http://toniamensal.ovh/",
  "numcols" => 4,          //Num de columnes en
  "tipus_cistella" => "session"
);
 */
?>
