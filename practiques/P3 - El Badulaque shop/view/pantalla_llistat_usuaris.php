<?php include ("_top.php"); ?>

<h1> Usuaris</h1>
<table border=1>
    <tr><td><b>Nom usuari</b></td><td><b>Tipus<b></td><td><td></tr>
<?php foreach ($dades as $row) { ?>
  	// output data of each row
    <tr>
        <td><?php echo $row["nom"] ?></td><td><?php echo $row["tipus_usuari"] ?></td>
        <td><a onclick="javascript: return confirm('Segur');"
               href="index.php?controller=usuaris&action=delete&id=<?php echo $row["id"] ?>">Borrar</a></td>
    </tr>
<?php } ?>
</table>
<a href="index.php?controller=usuaris&action=add"><button>Nou Usuari</button></a><br><br>

<?php include ("_bottom.php"); ?>