<?php
include "bdd.php";

$result = $conn->query('SELECT * FROM COMANDA ORDER BY DATA');

//die(var_dump($result));  //xtoni

// Ara passam les dades a l'array multidimensional $comandes i hi afegeixo
$comandes_aux = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$comandes_aux[] = $row;
	}
}

$comandes = array();
//Creo un array definitiu de comandes, on afegiré els ingredients amb un array extra.
foreach ($comandes_aux as $com) {
	//Obtenc el nom dels ingredients.
	$sql = "SELECT INGREDIENT.NOM FROM INGREDIENT JOIN INGREDIENTS_COMANDA ".
	 			 " WHERE INGREDIENT.CODI = INGREDIENTS_COMANDA.CODI_INGREDIENT AND ".
				 " INGREDIENTS_COMANDA.ID_COMANDA = {$com['ID']}";
	$result2 = $conn->query($sql);

//die("SELECT NOM FROM INGREDIENTS_COMANDA WHERE id_comanda={$com['ID']}");
	//Itero per obtenir ingredients i guardar en un string
	$ingredients="";
  if ($result2->num_rows > 0)
		while($row2 = $result2->fetch_assoc()) {
	 		$ingredients .= ucfirst($row2['NOM']).", ";
		}
		$com['INGREDIENTS'] = substr($ingredients,0,-2);

		//Data i hora
		$date = strtotime($com['DATA']);
		//https://stackoverflow.com/questions/136782/convert-from-mysql-datetime-to-another-format-with-php
		//Respost de TIM BOLAND!  xtoni
		$com['DIA'] =   date('d/m/y', $date);
		$com['HORA'] = 	date('g:i A', $date);

		//Pizza
		switch ($com["PIZZA"]) {
			case 'MAR':
				$com["PIZZA"] = "Margarita";
			break;
			case 'EST':
				$com["PIZZA"] = "4 Estacions";
			break;
			case 'NAP':
				$com["PIZZA"] = "Napolitana";
			break;
			case 'QUE':
				$com["PIZZA"] = "4 Formatges";
			break;
		}

		//Mida
		switch ($com["MIDA"]) {
			case 'M':
				$com["MIDA"] = "Petita";
			break;
			case 'L':
				$com["MIDA"] = "Normal";
			break;
			case 'XL':
				$com["MIDA"] = "Gran";
			break;
			case 'XXL':
				$com["MIDA"] = "Extra Gran";
			break;
		}

  	//Vaig creant array amb les dades que necessito per mostrar.
	  $comandes[] = $com;
}
?>

<!--
https://www.w3schools.com/bootstrap/bootstrap_tables.asp
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pizzeria SONFE - Llistat de Comandes</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body { padding-left: 10px; }
  </style>
</head>
<body>
<h1>PIZZERIA 'SONFE'</h1>
<H2>Llistat de Comandes disponibles</H2>
<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Dia</th>
				<th>Hora</th>
				<th>Nom complet</th>
				<th>Correu electrònic</th>
				<th>Pizza</th>
				<th>Mida</th>
				<th>Ingredients</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>

<?php
foreach ($comandes as $comanda) {
  echo "<tr>";
	echo "<td>{$comanda["DIA"]}</td>";
	echo "<td>{$comanda["HORA"]}</td>";
	echo "<td>{$comanda["NOM"]} {$comanda["LLINATGES"]}</td>";
	echo "<td>{$comanda["EMAIL"]}</td>";
	echo "<td>{$comanda["PIZZA"]}</td>";
	echo "<td>{$comanda["MIDA"]}</td>";
	echo "<td>{$comanda["INGREDIENTS"]}</td>";
	echo "<td>{$comanda["PREU"]}</td>";
	echo "<td><a href='delete.php?id={$comanda["ID"]}'><img src='img/delete.png' height='15' width='15'></a></td>";
	echo "</tr>";
}
?>
			</tbody>
		</table>
	</div>
<p><a href="altas.php">Fer una comanda</a></p>

</body>
</html>
