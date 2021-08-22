
<?php

session_start();
include 'secure.php';
require "../dbConnect.php";

try {
  $idPlat = $_GET['plateau'];
  $scriptdelPlat ="UPDATE `DB_Pyrobel`.`plateau`
                   SET `deleted` = '1'
                   WHERE (`idPlateau` = '$idPlat');";
  $deleteUser=$db->query($scriptdelPlat);


  echo "success!<br />";
  header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
}
//catch exception
catch(Exception $e) {
  echo '<br />Message: ' .$e->getMessage();
}
 ?>
