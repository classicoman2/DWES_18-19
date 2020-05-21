<html>
  <head>
    <title>Smarty</title>
  </head>
  <body>
    <h1> Usuaris</h1>
    <table border=1>
    	<tr><td><b>Nom usuari</b></td><td><b>Tipus<b></td><td><td></tr>
{foreach $dades as $row}
      <tr><td>{$row.nom}</td><td>{$row.tipus_usuari}</td>
          <td><a onClick="javascript: return confirm('Segur');"
                 href='index.php?controller=usuaris&action=delete&id={$row.id}'>Borrar</a></td>
      </tr>
{foreachelse}
    There were no rows found.
{/foreach}
  	 </table>
    <a href="index.php?controller=usuaris&action=add"><button>Nou Usuari</button></a><br><br>
  </body>
</html>
