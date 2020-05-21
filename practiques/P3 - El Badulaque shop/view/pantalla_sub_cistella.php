<?php
/*
CISTELLA DE LA COMPRA

NOTA: el codi comentat correspon a una cistella implementada usant COOKIES
      enlloc de la superglobal $_SESSION
*/
$items=0;  //Comptador de nº items de la cistella

if (isset( $_SESSION['cistella'] /* $_COOKIE[ $_SESSION['myusername'] ] */ )) {
  $items=0;
  foreach( $_SESSION['cistella'] /*$_COOKIE[ $_SESSION['myusername'] ]*/ as $i => $valor)
      $items++;
}
echo "<img id=\"cistellalogo\" src=\"view/images/cart.png\" alt=\"Cistella:\"/>
      <span id=\"cistellacount\">$items</span>";

//Botó de Checkout
echo "<br><a href=\"index.php?controller=compres&action=checkout\">Checkout</a>";
?>
