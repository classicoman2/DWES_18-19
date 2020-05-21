<?php
//die(var_dump($_SERVER));

if ($_SERVER['SERVER_NAME']=="localhost") {
  $servername = "localhost";
  $username = "root";
  $password = "Asdfg123";
  $bdd="RESTAURANT5";
} else {
  $servername = "toniamenlptoni.mysql.db";
  $username = "toniamenlptoni";
  $password = "Asdfg123";
  $bdd="toniamenlptoni";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $bdd);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
