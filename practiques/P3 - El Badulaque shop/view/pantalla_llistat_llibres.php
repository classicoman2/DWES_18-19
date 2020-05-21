<?php include ("view/_top.php"); ?>

<h1>Productes:</h1>

<select name="genere" id="ordenaLlibres" onchange="ordenaLlibres()">
  <option selected disabled>Ordenar per:</option>
  <option value="preu-asc">Preu Asc</option>
  <option value="preu-desc">Preu Desc</option>
  <option value="autor-asc">Autor Asc</option>
  <option value="autor-desc">Autor Desc</option>
 </select>
<br>

  <div class="container">

<?php
  //Numero de llibre
  $n=0;
  foreach ($dades as $row) {
    echo (($n%$helper->numcols()) == 0) ? "<div class='row'>" : "";
  	echo "<div class='col-lg-3 cella' width='210px' align='center'>";

    //url del producte
    if ($helper->clean_urls()) {
        echo "<a href='{$helper->directori()}llibre/{$row["id"]}'>";
    } else {
        echo "<a href='{$helper->directori()}index.php?controller=llibres&action=mostra&id={$row["id"]}'>";
    }

    echo   "<img style='border:0;height:150px' src='{$helper->directori()}imatges/llibres/{$row["imatge"]}' alt='No foto' />".
         "</a>".
         "<div><b>{$row["titol"]}</b></div><div>{$row["autor"]}</div>".
         "<div><b>{$row["preu"]}€</b></div>".
         "<div>{$row["genere"]}</div>";

    if ( isset($_SESSION['tipus_usuari']) ) {
      if ($_SESSION['tipus_usuari']=="administrador") {
        echo "<a href='index.php?controller=llibres&action=edit&id={$row["id"]}'>  <img src=\"imatges/edit.jpg\" alt=\"Editar\"/> </a>".
             "<a onClick=\"javascript: return confirm('Segur');\" href='index.php?controller=llibres&action=delete&id={$row["id"]}'>   <img src=\"imatges/delete.gif\" alt=\"Borrar\"/> </a>";
              /*    echo "<a href='http://proj1.localhost.com/llibrejson/{$row["id"]}'>JSON</a>
                          <a href='index.php?pag=rest&id={$row["id"]}'>REST</a>";*/
      }

    }
    echo ($n%$helper->numcols() == ($helper->numcols()-1)) ? "</div></div>" : "</div>";
    $n++;
}

?>
</div>

<?php include ("_bottom.php"); ?>
