<?php include ("_top.php"); ?>

<div class="container">
  <form enctype="multipart/form-data"
      action= "index.php?controller=usuaris&action=<?php echo ($pag=="edit") ? "update" : "insert"; ?>"
      method="post">

<?php 	if ($pag=="edit") { ?>
    Id: <input type="text" name="id" value="<?php echo $fila['id'] ?> " readonly><br>
<?php } ?>

    <br>
    <div class="form-group">
      <label for="user">Usuari:</label>
      <input type="text" class="form-control" id="email" placeholder="Introdueix nom d'usuari" name="nom" value="<?php if (isset($nom)) echo $nom;?>">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Introdueix contrasenya" name="password">
    </div>
    <div class="form-group">
      <label for="pwd">Repeteix Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Torna a introduir la contrasenya" name="password2">
    </div>

    <input type="submit" value="Guardar">
<?php
   if ( isset($regErr) )
      echo "<div id='regErr'>$regErr</div>";
?>

  </form>
</div>

<?php include ("_bottom.php"); ?>
