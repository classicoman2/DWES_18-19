<?php
/**
 * PANTALLA DE PEDIDOS/COMPRES QUE HA REALITZAT UN USUARI
 */

/**
 * Pinta el total d'una compra
 * @param  float $total Total a escriure
 * @return Void
 */
function pintaTotal($total) {
  if ($total>0) {
      echo "<td colspan=1><td><td><b>TOTAL</b></td><td><b>$total €</b></td>";
  }
}

include ("_top.php");
?>


<div class="container">
  <h2>Les teves compres:</h2>
  <table class="table">
  <?php
  //id de la compra actual
  $id=0;
  $total=0;
  foreach($productes as $p) {
     //SubCapçalera i Totals
     if ($p['id_compra']!=$id) {
         //Totals
         pintaTotal($total);
         $total=0;
         //Capçalera
         $id = $p['id_compra'];
         echo "<tr>
            <td><i>{$p['data_compra']}</i> </td></tr>";
     }

     $parcial = $p['unitats']*$p['preu'];
     $total += $parcial;
     echo "<tr>".
            "<td></td>
            <td><b>{$p['titol']}</b>, <i>{$p['autor']}</i></td>".
            "<td>{$p['unitats']} x {$p['preu']}</td>".
            "<td>$parcial €</td>".
          "</tr>";
  }

  //Totals de la darrera compra
  pintaTotal($total);

  ?>
  </table>
</div>


<?php include ("_bottom.php"); ?>
