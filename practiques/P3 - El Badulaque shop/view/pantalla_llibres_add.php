<?php include ("_top.php"); ?>

<form enctype="multipart/form-data"
      action= "<?php echo $helper->directori(); ?>index.php?controller=llibres&action=<?php echo $action ?>" method="post">

    <input type="text" name="id" value="<?php echo $id ?>" hidden><br>

		Títol: <input type="text" name="titol"
		 						  value="<?php echo $titol ?>">
<?php echo (isset($errTitol)) ? $errTitol : ""; ?>
		<br>
		Autor: <input type="text" name="autor"
								  value="<?php echo $autor; ?>">
		<br>
    <select name="genere">
      <option value="assaig" <?php echo ($genere=="assaig") ? "selected" : ""; ?> >Assaig</option>
      <option value="comic" <?php echo ($genere=="comic") ? "selected" : ""; ?>  >Comic</option>
      <option value="ficcio" <?php echo ($genere=="ficcio") ? "selected" : ""; ?> >Ficció</option>
      <option value="idiomes" <?php echo ($genere=="idiomes") ? "selected" : ""; ?> >Idiomes</option>
      <option value="infantil" <?php echo ($genere=="infantil") ? "selected" : ""; ?> >Infantil</option>
     </select>
    <br>
	  Data entrada: <input type="date" name="data_entrada"
								  value="<?php echo $data_entrada; ?>">
		<br>
    Preu: <input type="text" name="preu" value="<?php echo $preu; ?>">
    <br>
				 Imatge: <input type='file' name='imatge'/>
    <br><br><br>
 		<input type="submit" name="<?php echo $action ?>" value="Guardar">
		<?php echo (isset($sqlError)) ? $sqlError : ""; ?>

</form>

<?php include ("_bottom.php"); ?>
