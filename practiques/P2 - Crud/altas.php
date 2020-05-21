<?php
// Notificar todos los errores excepto E_NOTICE   //xtoni
error_reporting(E_ALL ^ E_NOTICE);

include "bdd.php";

//Aconsegueixo la llista d'ingredients disponibles
$result = $conn->query('SELECT * FROM INGREDIENT ORDER BY NOM');

$ingredients = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$ingredients[$row['CODI']] = $row["NOM"];
	}
}
?>

<!-- HTML del form obtingut de:
    https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete
-->

<!DOCTYPE HTML>
<html>
  <head>
  <title>Pizzeria SONFE - Formulari de Comandes</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
     .error {color: #FF0000;}
     form { padding-left: 10px; }
     body { padding-left: 10px; }
  </style>
  </head>
  <body>
  <h1>PIZZERIA 'SONFE'</h1>
  <h2>Formulari de Comanda de Pizzes</h2>
  <p><span class="error">* Camp Obligatori</span></p>
  <form method="post" action="insert.php">
    Nom: <input type="text" name="name" size="18" maxlength="25" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Llinatges: <input type="text" name="surname" size="49" maxlength="60" value="<?php echo $surname;?>">
    <span class="error">* <?php echo $surnameErr;?></span>
    <br><br>
    DNI: <input type="text" name="dni" size="5" maxlength="9" value="<?php echo $dni;?>">
    <span class="error">* <?php echo $dniErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email" size="40" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>

    Tria la teva pizza:
    <select name="genere">
      <option value="MAR">Margarita - 8€</option>
      <option value="EST">4 Estacions - 10,50€</option>
      <option value="NAP">Napolitana - 9€</option>
      <option value="QUE">4 Formatges - 11,25€</option>
     </select>

    <!-- https://www.w3schools.com/html/tryit.asp?filename=tryhtml_radio -->
    <br><br>Mida de la pizza: <br>
    <input type="radio" name="mida" value="M">M (preu base)
    <input type="radio" name="mida" value="L" checked>L (+ 2,5€)
    <input type="radio" name="mida" value="XL">XL (+ 5€)
    <input type="radio" name="mida" value="XXL">XXL (+ 9€)

    <br><br>Ingredients (0,50€ per ingredient): <br>
<?php
    foreach ($ingredients as $codi => $nom) {
      echo "<input type=\"checkbox\" name=\"$codi\" value=\"$codi\">".ucfirst($nom);
    }
?>
    <br><br><input type="submit" name="submit" value="Confirmar comanda">
  </form>

  <br><br><a href="index.php"> Torna al llistat de comandes </a>
</body>
</html>
