<?php

// Definir les variables que necessito.
$name  = $surname = $email = $dni = $size = $ingredients = "";
$name  = $surnameErr = $emailErr = $dniErr = $sizeErr = $ingredientsErr  = "";

/**
 * Xequeja si el DNI és correcte
 *                  http://www.bufa.es/php-funcion-validar-dni/
 * @param  [string] $nif Nif
 * @return [boolean]
 */
function check_dni_format($dni) {
  $letra = substr($dni, -1);
  	$numeros = substr($dni, 0, -1);
  	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
  		return true;
  	} else{
  		return false;
  	}
}

/**
 * Neteja de camp textual
 * @param  [string] $data [Contingut de camp <input> sense netejar]
 * @return [string]       [Camp netejat]
 */
function test_input($data) {
  //Elimina espais en blanc
  $data = trim($data);
  //Elimina barres / innecessàries, procedents d'algun escape...
  $data = stripslashes($data);
  //Evita atac XSS
  $data = htmlspecialchars($data);
  return $data;
}

//S'ha processat el Formulari?
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "El camp Nom no es pot deixar buid";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace     // xtoni
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Només se permeten lletres o espais en blanc en el camp de Nom";
    }
  }

  if (empty($_POST["surname"])) {
    $surnameErr = "El camp Llinatges no es pot deixar buid";
  } else {
    $surname = test_input($_POST["surname"]);
    // check if name only contains letters and whitespace     // xtoni
    if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
      $surnameErr = "Només se permeten lletres o espais en blanc en el camp Llinatges";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "El camp email no es pot deixar buid";
  } else {
    $email = test_input($_POST["email"]);
    // Comprovar si l'email és vàlid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {   // xtoni
      $emailErr = "El format del email introduït és incorrecte!";
    }
  }

  if (empty($_POST["dni"])) {
    $dniErr = "És obligatori introduir el DNI";
  } else {
    $dni = test_input($_POST["dni"]);
    //Comprovar si s'han introduit 8 numeros i una lletra
    if (  (!preg_match("/^[0-9]*$/",substr($dni, 0, 8) ) )  || (!preg_match("/^[a-zA-Z ]*$/",substr($dni, -1)  ) )    ) {
        $dniErr = "No s'han introduït 8 numeros i una lletra";
    }
    else {
      // Comprovar si la lletra és correcte
      if (!check_dni_format($dni)) {
        $dniErr = "El DNI introduït és incorrecte";
      }
    }

    $mida = $_POST["mida"];

  }

  //Comprova si ha anat bé
  if (  !empty($nameErr) || !empty($surnameErr) || !empty($dniErr) || !empty($emailErr) ) {
    //Hi ha un error
    include ("form_pedidos.php");

  } else {

      $total = 0;

      //Genere
      switch ($_POST['genere']) {
        case 'marg':
          $total += 8;
          $nomGenere = 'Margarita';
        break;
        case 'esta':
          $total += 10.50;
          $nomGenere = '4 Estacions';
        break;
        case 'napo':
          $total += 9;
          $nomGenere = 'Napolitana';
        break;
        case 'ques':
          $total += 11.25;
          $nomGenere = '4 Formatges';
        break;
      }

      //Mida
      switch ($_POST['mida']) {
        case 'M':
          $total += 0;
          $nomMida = 'Petita';
        break;
        case 'L':
          $total += 2.5;
          $nomMida = 'Normal';
        break;
        case 'XL':
          $total += 5;
          $nomMida = 'Gran';
        break;
        case 'XXL':
          $total += 9;
          $nomMida = 'Extragran';
        break;
      }

      //ingredients
      $ingredients = array('cheese'=>'formatge',
      'pepper' => 'pepperoni',
      'xampi'  => 'xampinyons',
      'bacon' => 'bacon');
      $selecció = array();
      foreach ($ingredients as $code => $ing) {
        if (isset($_POST[$code])) {
          $total += 0.50;
          $seleccio[] = $ing;
        }
      }

      $missatge = "<h3>La teva comanda:</h3>";
      $missatge .= "<p>Una pizza $nomGenere de mida $nomMida ";
      if (sizeof($seleccio)==0) {
        $missatge .= ".";
      }
      else {
        $missatge .= "amb ";
        foreach ($seleccio as $ing) {
          $missatge .= "$ing,";
        }
      }

      //Elimina l'última coma.
      $missatge = substr($missatge, 0, (strlen($missatge)-1));

      echo "<p>{$missatge}<p>";

      echo "<p>Preu: $total €</p>";

      echo "<h3>Les teves dades</h3>";

      echo "Nom: $name<br>";
      echo "Llinatges: $surname<br>";
      echo "Email = $email";
  }

}
?>
