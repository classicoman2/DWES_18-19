<?php


require_once "session_start.php";

require_once("db/db.php");

//Funciones para el controlador frontal
include 'core/ControladorFrontal.func.php';
//https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/

//L'empro pel generador de vistes   view()
include 'core/ControladorBase.php';


//https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
//Cargamos controladores y acciones
if(isset($_GET["controller"])){
    $controllerObj=cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
    exit;
}else {
  /*  //Controlar si la url és defectuosa; en aquest cas, donar error 404
    $querystring=$_SERVER['QUERY_STRING'];  //El que ve després de index.php?
    if (!empty($querystring)) {
        //404
        $controllerObj=cargarControlador( "llibres" );
        $controllerObj->view404();
        exit;
    } else {*/
        //Default controller/Action
        $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
        lanzarAccion($controllerObj);
        exit;
    /*}*/
}


/*
            //En aquest cas, utilitza la interface REST del meu projecte LARAVELTEST/proj1
            //Per a obtenir i mostrar un llibre
            //Codi obtingut de pg 342 i anteriors del llibre 'Programming PHP'
            //xtoni: pdt passar-ho a un controlador !!!
            case "rest":
              $url = "http://proj1.localhost.com/llibrejson/{$_GET['id']}";

              //si dona error diguent que aquesta funcio no està definida, descomentar
              //la linia  ;extension=php_curl.dll  a php.ini   i  sudo apt-get install php-curl
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);

              //Per evitar que faci echo del JSON en la pantalla:
              // https://stackoverflow.com/questions/1918383/dont-echo-out-curl
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

              $response = curl_exec($ch);
              $resultInfo = curl_getinfo($ch);

//echo var_dump($resultInfo);
              curl_close($ch);


              //Fer Decode del JSON en un array associatiu
              //OJO: el segon parametre , true, és basic per evitar lios,
              //https://stackoverflow.com/questions/6815520/cannot-use-object-of-type-stdclass-as-array
              $fila = json_decode($response, true);


              //Mostram provisionalment la pantalla de fer modificacions.
              $pag = "updatepag";
              include "view/pantalla_llibres_add.php";

              break;

              case "restput":
                  $url =  "http://proj1.localhost.com/llibrejsonput/{$_GET['id']}";
                  $data = json_encode(array(
                      'autor' => "john barry"
                  ));

                  $requestData = http_build_query($data, '', '&');

                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);

                  $fh = fopen("php://memory", 'rw');
                  fwrite($fh, $requestData);
                  rewind($fh);

                  curl_setopt($ch, CURLOPT_INFILE, $fh);
                  curl_setopt($ch, CURLOPT_INFILESIZE, mb_strlen($requestData));

                  curl_setopt($ch, CURLOPT_PUT, true);

                  $response = curl_exec($ch);
                  $resultInfo = curl_getinfo($ch);
                  curl_close($ch);
                  close($fh);
              break;
      }

  } */
