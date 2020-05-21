<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	     <title><?php echo $helper->titolweb(); ?></title>
       <link rel="stylesheet" type="text/css" href="<?php echo $helper->directori(); ?>css/estils.css"/>
       <link rel="stylesheet" type="text/css" href="<?php echo $helper->directori(); ?>css/drop_down_menu.css"/>

<!--- Bootstrap  -->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



    </head>
    <body>
    <div id="wrapper">
      <div id="header" class="<?php
    if (isset($_SESSION['tipus_usuari']))
       if ($_SESSION['tipus_usuari']=="client")
          echo "header";
       else {
          echo "header_admin";
       }
    else   echo "header";
?>">
        <div id="logo">
            <a href="<?php echo $helper->directori(); ?>index.php">
              <img src="<?php echo $helper->directori(); ?>view/images/logo.jpg" alt="Logo"/>
            </a>
        </div>
        <div id="title"><?php echo $helper->titolweb(); ?></div>

<?php
/* SECCCIO CISTELLA */
        if (isset($_SESSION['tipus_usuari']))
          if ($_SESSION['tipus_usuari']=="client") {
             echo "<div id=\"cistellablock\">";
             include "view/pantalla_sub_cistella.php";
             echo "</div>";
        }
?>

        <div id="usernameblock">

<?php
/* SECCIO LOGIN */
          if  ( isset($_SESSION['myusername']) ) {
              echo "Usuari: {$_SESSION['myusername']}";
              echo "<br><a href=\"index.php?controller=usuaris&action=logout\"><button>Logout</button></a>";
          } else {
              include("view/pantallasub_login.php");
          }
?>
        </div>
      </div>


<!--  https://getbootstrap.com/docs/3.3/components/#navbar  -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="index.php?controller=llibres&action=llista&filtre=assaig">Assaig</a></li>
                  <li><a href="index.php?controller=llibres&action=llista&filtre=comic">Comic</a></li>
                  <li><a href="index.php?controller=llibres&action=llista&filtre=ficcio">Ficció</a></li>
                  <li><a href="index.php?controller=llibres&action=llista&filtre=idiomes">Idiomes</a></li>
                  <li><a href="index.php?controller=llibres&action=llista&filtre=infantil">Infantil</a></li>
                </ul>
              </li>
            </ul>
<?php
                  if (isset($_SESSION['tipus_usuari'])) {
                      if ($_SESSION['tipus_usuari']=="client") {
?>
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">El meu perfil<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="index.php?controller=compres&action=llista">Les meves comandes</a></li>
                </ul>
              </li>
            </ul>
<?php   }  }  ?>


          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>


</div>
