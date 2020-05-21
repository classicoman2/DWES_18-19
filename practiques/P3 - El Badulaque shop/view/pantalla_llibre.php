<?php include (getcwd()."/view/_top.php"); ?>

<div id="contenidor">
    <div id="leftcol">

      <img style='border:0;height:300px'
           src='<?php echo $helper->directori()."imatges/llibres/$imatge"; ?>'
           alt='No foto' />
    </div>
    <div id="rightcol">
        <h3> <?php echo $titol ?> </h3>


          <table border=1>
            <tr><td width='450px' align='center'></td></tr>
            <tr><td> <b><?php echo $titol ?></td></tr>
            <tr><td> <?php echo $autor ?></td></tr>
            <tr><td> <b><?php echo $preu ?> euros</td></tr>
            <tr><td> <i><?php echo $genere ?></i></td></tr>
            <tr><td> <i><?php echo $descripcio ?></i></td></tr>
          </table>
    </div>

    <div id="formcol">
      <form action="index.php?controller=compres&action=afegir&id=<?php echo $id ?>" method="post">
        <table>
          <tr><td> Unitats:<input name="unitats" type="number" value="1"></td></tr>
          <tr><td> <input type="submit" value="Comprar"> </td></tr>
        </table>
      </form>
    </div>
</div>

<?php include ("_bottom.php"); ?>
