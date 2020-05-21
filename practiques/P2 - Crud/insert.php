<?php
include "bdd.php";

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
    include ("altas.php");

  } else {

      $preu = 0;

      //Genere
      switch ($_POST['genere']) {
        case 'MAR':
          $preu += 8;
        break;
        case 'EST':
          $preu += 10.50;
        break;
        case 'NAP':
          $preu += 9;
        break;
        case 'QUE':
          $preu += 11.25;
        break;
      }

      //Mida
      switch ($_POST['mida']) {
        case 'M':
          $preu += 0;
        break;
        case 'L':
          $preu += 2.5;
        break;
        case 'XL':
          $preu += 5;
        break;
        case 'XXL':
          $preu += 9;
        break;
      }

      //capturar els codis dels ingredients seleccionats.

      //Aconsegueixo la llista d'ingredients disponibles
      $result = $conn->query('SELECT * FROM INGREDIENT ORDER BY NOM');
      $ingredients = array();
      if ($result->num_rows > 0) {
      	while($row = $result->fetch_assoc()) {
      		$ingredients[$row['CODI']] = $row["NOM"];
      	}
      }
      $seleccio = array();
      foreach ($ingredients as $code => $ing) {
        if (isset($_POST[$code])) {
          $preu += 0.50;
          $seleccio[] = $_POST[$code];
        }
      }

        //https://stackoverflow.com/questions/470617/how-to-get-the-current-date-and-time-in-php
      //Resposta de MAHDI
      $now = new DateTime();
      $data = $now->format('Y-m-d H:i:s');    // MySQL datetime format  //xtoni

      //INSERTAR COMANDA
      $sql = "INSERT INTO COMANDA (DATA,NOM,LLINATGES,DNI,EMAIL,PIZZA,MIDA,PREU) ".
             "VALUES ('$data','$name','$surname','$dni','$email','{$_POST['genere']}','{$_POST['mida']}',$preu)";  //xtoni  pdt acabar.

      if ($conn->query($sql) === TRUE) {
         //OK
      } else {
         die("Error: " . $sql . "<br>" . $conn->error);
      }


      //INSERTAR INGREDIENTS

      //Id de la comanda darrera
      //https://stackoverflow.com/questions/2708992/mysql-limit-from-descending-order
      $result = $conn->query("SELECT ID FROM COMANDA ORDER BY ID DESC LIMIT 1");
      $row = $result->fetch_assoc();

      //Insertar ingredients
      foreach ($seleccio as $codi) {
        $sql = "INSERT INTO INGREDIENTS_COMANDA (ID_COMANDA,CODI_INGREDIENT) ".
                "VALUES ('{$row['ID']}', '$codi')";

        if ($conn->query($sql) === TRUE) {
          //OK
        } else {
           die("Error: " . $sql . "<br>" . $conn->error);
        }
      }

      header('Location: index.php');

  }

}
?>
