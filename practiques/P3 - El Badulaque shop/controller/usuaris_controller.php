<?php
require_once("model/usuaris_model.php");

class usuaris_controller extends ControladorBase {


public function add() {
      //Carrega vista pantalla de registre
      $this->view("pantalla_usuaris_add.php",array(
          "pag" => "add",
          "nom" => ""
      ));
}

/*
  Acció: Donar de Baixa d'un llibre
*/
public function delete() {
    $usuaris = new usuaris_model();

    $id = $_GET['id'];

    $usuaris->delete($id);
    //mostra pantalla llistat
    header("location: index.php?controller=usuaris&action=llista");
}

/**
 * Realitza login
 */
public function login() {
  $usuaris = new usuaris_model();

  # Revisar si el nom d'usuari és alfanumèric (ni guions ni guions baixos poden emprar-se pels noms d'usuari
  $clean = array();
  if (ctype_alnum( $_POST['myusername'] )) {
      $clean['username'] =  $_POST['myusername'];
  } else {
      $this->mostrar_pantalla_login("Format del nom d'usuari incorrecte, no alfanumeric");
      exit;
  }

  $mysql = array();
  $mysql['username'] =  $clean['username']; //mysqli_real_escape_string( $clean['username'] );

  $fila = $usuaris->getUser( $mysql['username'] );

  //EXISTEIX L'USUARI?
  if ($fila !== false) {

    //Control de número d'intents
    /*
    if (isset($_SESSION[ 'intents' ])) {
      if ($_SESSION['intents'] == 3) {
        echo "Maxim nombre intents";
          exit;
      }
    }
    */

    // http://php.net/manual/en/function.crypt.php
    if ( hash_equals($fila['password'], crypt($_POST['mypassword'], $fila['password'])) ) {
        /* Si hi ha un registre, això vol dir que l'Usuari i la Contrasenya son correctes */

      $_SESSION['myusername'] = $mysql['username'] ;

      //tipus d'usuari
      $_SESSION['tipus_usuari'] = $fila['tipus_usuari'];

      //$_SESSION['intents'] = 0;

      //Redirigeixo a Index per a que mostri el llistat.
      header('Location: index.php');
    } else {
          //Control de número d'intents
          /*    if (isset ($_SESSION[ $mysql['intents'] ]) ) {
                   $_SESSION[ $mysql['intents'] ] ++;
                } else {
                   $_SESSION[ $mysql['intents'] ] = 1;
                }
          */
          $loginErr = "Contrasenya errònia";

    }
  } else {
    $loginErr = "L'usuari no existeix";
  }

  if (!empty($loginErr)) {
    /* mostrar de nou la home*/
    header("location: index.php?loginErr=".urlencode($loginErr));
  }
}



/*
  Acció: Fer Logout
*/
public function logout() {

    if (isset($_SESSION['myusername']))  {
        unset($_SESSION['myusername']);
    }

    session_destroy();

    header("location: index.php");
}



/*
  Acció: Mostrar la Pantalla de Llistat
  Usam el TEMPLATE:  SMARTY xtoni
*/
public function llista() {
    $usuaris = new usuaris_model();
    //Obté llistat de usuaris
    $dades = $usuaris->getAll();

    // put full path to Smarty.class.php
    require('smarty-3.1.30/libs/Smarty.class.php');
    $smarty = new Smarty();

    $smarty->setTemplateDir('smarty/templates');
    $smarty->setCompileDir('smarty/templates_c');
    $smarty->setCacheDir('smarty/cache');
    $smarty->setConfigDir('smarty/configs');

    $smarty->assign('dades', $dades);

    $smarty->display('view/pantalla_llistat_usuaris.tpl');


/*
    //Carrega vista d'usuaris
    $this->view("pantalla_llistat_usuaris.php",array(
        "dades" => $dades
    ));
*/
}

/*
  Acció: Donar d'Alta d'un llibre
*/
public function insert() {
   $usuaris = new usuaris_model();

   //Agafar camps i crear alta.
   //TITOL no pot estar buid
   $regErr = "";

   if (empty($_POST["nom"]))
      $regErr = "El nom de usuari no pot estar buid";
   else if (strlen($_POST['nom'])>20)
      $regErr = "El nom d'usuari és massa llarg";
   else if ($usuaris->getUser($_POST["nom"])!==false)
      $regErr = "El nom de usuari ja existeix";
   else if ( preg_match('/\s/',$_POST["nom"]) )
      $regErr = "El nom d'usuari no pot contenir espais en blanc";

   else if ( preg_match('/\s/',$_POST["password"]) )
      $regErr = "La contrasenya no pot contenir espais";
   else if (strlen($_POST['password'])<8)
      $regErr = "La contrasenya és massa curta";

   else if ($_POST["password"] !== $_POST["password2"])
      $regErr = "No coincideixen les contrasenyes";



   //Registre correcte
   if (empty($regErr)) {
     $nom      = $usuaris->netejar_camps($_POST["nom"]);
     $password = $usuaris->netejar_camps($_POST["password"]);

     $usuaris->insert($nom,$password);

     //Inicia la sessió amb l'usuari que s'acaba de registrar.
     $_SESSION['myusername'] = $nom;
     $this->redirect("llibres", "llista");
     //header("Location: index.php?controller=usuaris&action=llista");
   }
   //Registre amb errors
   else  {
     //Carrega vista pantalla de registre
     $this->view("pantalla_usuaris_add.php",array(
         "pag" => "add",
         "nom" => $_POST["nom"],
         "regErr" => $regErr
     ));
   }
}

}
?>
