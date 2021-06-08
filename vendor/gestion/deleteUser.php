<?php
session_start();
include 'secure.php';
require "../dbConnect.php";

try {
  $idUser = $_GET['user'];
  $scriptdelUser ="DELETE FROM `DB_Pyrobel`.`user` WHERE (`iduser` = '$idUser');";
  $deleteUser=$db->query($scriptdelUser);


  echo "success!<br />";
  echo $scriptdelUser;
  header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
}
//catch exception
catch(Exception $e) {
  echo '<br />Message: ' .$e->getMessage();
}
