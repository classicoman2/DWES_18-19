<?php include ("_top.php"); ?>

<div class="container">
  <h2>La teva comanda:</h2>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Títol</th>
        <th>Autor</th>
        <th></th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
<?php
$total = 0;
foreach($productes as $row) {
   echo "<tr>".
        "<td><img src='imatges/llibres/{$row['imatge']}' style='height:80px'></td>".
        "<td>{$row['titol']}</td><td><i>{$row['autor']}</i></td>".
        "<td>{$row['unitats']} unitats x {$row['preu']}€ </td><td>". $row['preu']*$row['unitats'] ." €</td>".
        "</tr>";
        $total += $row['preu']*$row['unitats'];
}
echo "<tr>
        <td colspan=4></td> <td><h4>$total €</h4></td>
      </tr>";
//echo "<br>". serialize($productes) . "<br>";
?>
    </tbody>
  </table>
</div>

<br>
<div id="linkGeneral">
  <a href="index.php?controller=compres&action=save&productes=<?php echo urlencode(serialize($productes)) ?>">Confirmar Compra</a>
</div>
<?php include ("_bottom.php"); ?>
