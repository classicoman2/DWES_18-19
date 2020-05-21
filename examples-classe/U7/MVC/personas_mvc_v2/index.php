<?php
require_once("db/db.php");

require_once("controllers/personas_controller.php");

if (isset($_GET['controller']) && isset($_GET['action']) ) {
    if ($_GET['controller'] == "personas") {

         if ($_GET['action'] == "add") {
           $controller = new personas_controller();
           $controller->add();
         }

         if ($_GET['action'] == "insert") {
           $controller = new personas_controller();
           $controller->insert();
         }

         if ($_GET['action'] == "delete") {
           $controller = new personas_controller();
           $controller->delete();
         }

    }

} else {
   $controller = new personas_controller();
   $controller->view();
}
?>
