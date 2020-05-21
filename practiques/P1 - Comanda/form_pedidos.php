<!-- HTML del form obtingut de:
    https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete
-->

<!DOCTYPE HTML>
<html>
  <head>
    <style>
      .error {color: #FF0000;}
    </style>
  </head>
  <body>

<?php
// Notificar todos los errores excepto E_NOTICE   //xtoni
error_reporting(E_ALL ^ E_NOTICE);
?>

  <h1>PIZZERIA 'SONFE'</h1>
  <h2>Formulari de Comanda de Pizzes</h2>
  <p><span class="error">* Camp Obligatori</span></p>
  <form method="post" action="procesa_pedidos.php">
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
      <option value="marg">Margarita - 8€</option>
      <option value="esta">4 Estacions - 10,50€</option>
      <option value="napo">Napolitana - 9€</option>
      <option value="ques">4 Formatges - 11,25€</option>
     </select>

    <!-- https://www.w3schools.com/html/tryit.asp?filename=tryhtml_radio -->
    <br><br>Mida de la pizza: <br>
    <input type="radio" name="mida" value="M">M (preu base)
    <input type="radio" name="mida" value="L" checked>L (+ 2,5€)
    <input type="radio" name="mida" value="XL">XL (+ 5€)
    <input type="radio" name="mida" value="XXL">XXL (+ 9€)

    <br><br>Ingredients (0,50€ per ingredient): <br>
    <input type="checkbox" name="cheese" value="">Formatge
    <input type="checkbox" name="pepper" value="">Pepperoni
    <input type="checkbox" name="xampi"  value="">Xampinyons
    <input type="checkbox" name="bacon"  value="">Bacon

    <br><br><input type="submit" name="submit" value="Submit">
  </form>

</body>
</html>
