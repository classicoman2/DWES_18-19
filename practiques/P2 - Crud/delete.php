<?php
include "bdd.php";

$sql = "DELETE FROM COMANDA WHERE ID={$_GET['id']}";
$conn->query($sql);

header('Location: index.php');

?>
