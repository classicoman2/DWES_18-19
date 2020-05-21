<?php
require_once("model/llibres_model.php");

class llibres_controller extends ControladorBase {

/**
 * Mostrar la pantalla d'alta llibres
 */
public function add() {
     //Cargamos la vista
      $this->view("pantalla_llibres_add.php", array(
          "action"       => "insert",
          "id"           => "",
          "titol"        => "",
          "autor"        => "",
          "genere"       => "ficcio",
          "data_entrada" => "",
          "preu"         => ""
      ));
}


/**
 * Mostra la pantalla d'Edicio de llibre
 */
public function edit() {
    $llibres = new llibres_model();

    $id = $_GET['id'];
    //Obté dades del llibre
    $fila = $llibres->getById($id);

    //Cargamos la vista
    $this->view("pantalla_llibres_add.php",array(
            "action"        => "update",
            "id"            => $fila['id'],
            "titol"         => $fila['titol'],
            "autor"         => $fila['autor'],
            "genere"        => $fila['genere'],
            "data_entrada"  => $fila['data_entrada'],
            "preu"          => $fila['preu']
    ));
}


/**
 * Inserta llibre a BDD
 */
public function insert() {
  $llibre = new llibres_model();

   //TITOL no pot estar buid
   if (!empty($_POST["titol"])) {

       $imatge = "";
       if (!empty($_FILES['imatge']['name'])) {
           $imatge = $this->guarda_imatge( $llibre->netejar_camps($_POST["titol"]) );
           if ($imatge === FALSE)
               die("No s'ha pogut guardar la imatge, llibres_controller");
       }

       $llibre->setTitol( $llibre->netejar_camps($_POST["titol"]) );
       $llibre->setAutor($llibre->netejar_camps($_POST["autor"]));
       $llibre->setGenere($llibre->netejar_camps($_POST["genere"]));
       if (!empty($_POST["data_entrada"]))
           $llibre->setData_entrada($data_entrada = $llibre->netejar_camps($_POST["data_entrada"]));
      else
           $llibre->setData_entrada( date("Y-m-d") );

      $llibre->setPreu($_POST["preu"]);
      $llibre->setImatge($imatge);

       $error = $llibre->insert();

       if (!$error)
          // header() evita que amb refresc de pantalla es crei una altra alta o baixa.
          header("Location: ./index.php");
       else {
          die($error);
       }
   }
}

/**
 * Fa update de llibre
 */
public function update() {
   $llibre = new llibres_model();

   //TITOL no pot estar buid
   if (!empty($_POST["titol"])) {

       //Captura el fitxer d'imatge
       $imatge = "";
       if (!empty($_FILES['imatge']['name'])) {
           $imatge = $this->guarda_imatge( $llibre->netejar_camps($_POST["titol"]) );
           if ($imatge === FALSE)
               die("No s'ha pogut guardar la imatge, llibres_controller");
       }

       //Setters
       $llibre->setId($_POST['id']);
       $llibre->setTitol( $llibre->netejar_camps($_POST["titol"]) );
       $llibre->setAutor($llibre->netejar_camps($_POST["autor"]));
       $llibre->setGenere($llibre->netejar_camps($_POST["genere"]));
       if (!empty($_POST["data_entrada"]))
           $llibre->setData_entrada( $llibre->netejar_camps($_POST["data_entrada"] ));
       else
           $llibre->setData_entrada( date("Y-m-d") );
       $llibre->setPreu($_POST["preu"]);
       $llibre->setImatge($imatge);
       //Query
       $error = $llibre->update();

       if (!$error)
          // header() evita que amb refresc de pantalla es crei una altra alta o baixa.
          header("Location: ./index.php");
       else
          $sqlError = $error;

   } else {
     $sqlError = "Titol no pot estar buid!";
   }
   if (!empty($sqlError)) {
       //i Tornam a carregar la pantalla
       $this->view("pantalla_llibres_add.php",array(
               "action"       => "update",
               "id"           => $_POST["id"],
               "titol"        => $_POST["titol"],
               "autor"        => $_POST["autor"],
               "genere"        => $_POST["genere"],
               "data_entrada" => $_POST["data_entrada"],
               "preu"         => $_POST["preu"],
               "sqlError"        => $sqlError
       ));
   }

}

/**
 * Mostra la fitxa d'un llibre
 */
public function mostra() {
   $llibres = new llibres_model();

   //xtoni  Falta comprovar que el paràm és correcte.
   $id = $_GET['id'];

   $row = $llibres->getById($id);

   $this->view("pantalla_llibre.php",array(
               "id"        => $id,
               "titol"        => $row["titol"],
               // "descripcio"        => $row["descripcio"],
               "autor"        => $row["autor"],
               "genere"        => $row["genere"],
               "preu"         => $row["preu"],
               "imatge"         => $row["imatge"]
       ));
}


private function guarda_imatge( $name ) {
/*
   if(($handle = fopen($_FILES["imatge"]["tmp_name"], 'r')) == FALSE) {
      return "No he pogut obrir el fitxer {$_FILES["nomimatge"]["name"]}";
   }
*/
   //Ref: https://stackoverflow.com/questions/3509333/how-to-upload-save-files-with-desired-name -->
   $info = pathinfo($_FILES['imatge']['name']);
   $ext = $info['extension'];   // get the extension of the file
   $newname = $name.".".$ext;  //

   $target = 'imatges/llibres/'.$newname;
   if (move_uploaded_file( $_FILES['imatge']['tmp_name'], $target))
      return $newname;
   else {
      return FALSE;
   }
}

/*
  Acció: Donar de Baixa d'un llibre
*/
public function delete() {
    $llibres = new llibres_model();

    $id = $_GET['id'];
    $llibres->delete($id);
    //mostra pantalla llistat
    header("location: index.php");
}


/*
  Acció: Mostrar la Pantalla de Llistat
*/
public function llista() {
    $llibres = new llibres_model();

    if (isset($_GET['filtre'])) {

        //Diferents filtres
        $dades = $llibres->getAllfilteredByFieldValue("genere", $_GET['filtre']);

    } else {
        if (isset($_GET['ordre'])) {

            //Diferents Ordenacions
            switch ( $_GET['ordre'] ) {
                case "preu-asc":
                  $dades = $llibres->getAllorderedByField("preu", "ASC");
                  break;
                case "preu-desc":
                  $dades = $llibres->getAllorderedByField("preu", "DESC");
                  break;
                case "autor-asc":
                  $dades = $llibres->getAllorderedByField("autor", "ASC");
                  break;
                case "autor-desc":
                  $dades = $llibres->getAllorderedByField("autor", "DESC");
                  break;
            }
        } else
            $dades = $llibres->getAll();
    }

    //Cargamos la vista y le pasamos valores
        $this->view("pantalla_llistat_llibres.php",array(
            "dades" => $dades
        ));

}

/**
 * Aquesta funció no funcionarà si no està en marxa el servidor virtual (mirar
 *  la configuració al fitxer  global.php)
 * @return Void
 */
public function cleanurl() {
  $llibres = new llibres_model();

  if (isset($_GET['text'])) {
    //Executa la cerca
    $row = $llibres->getLlibreByCleanurl($_GET['text']);

    if ($row !== FALSE) {

       $this->view("pantalla_llibre.php",array(
                 "id"        => $row["id"],
                 "titol"        => $row["titol"],
                 "autor"        => $row["autor"],
                 "genere"        => $row["genere"],
                 "preu"         => $row["preu"],
                 "imatge"         => $row["imatge"]
       ));
    } else
      echo "PAGE NOT FOUND error 404"; //xtoni  todo001
  } else
      echo "PAGE NOT FOUND error 404"; //xtoni  todo001
}


public function view404() {
       //Cargamos la vista y le pasamos valores
        $this->view("404.php",array(
        ));
}


/*
 FUNCIONS PRIVADES.
*/
private function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

private function adapta_data($data) {
  return substr($data,8,2)."-".substr($data,5,2)."-".substr($data,0,4);
}



}

?>
