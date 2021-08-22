<?php

session_start();
include 'secure.php';
require "../dbConnect.php";
include_once 'newRequests.php';

$numPlateau=$_POST['numPlateau'];
$numCadre=$_POST['numCadre'];
$largeur=$_POST['largeur'];
$hauteur=$_POST['hauteur'];
$cmt=$_POST['cmt'];
$dateAjout = date('y/m/j');
$idPlateau;
$idType=$_POST['stype'];


try {
  $query="INSERT INTO `DB_Pyrobel`.`plateau` (`idEmplacement`, `numCadre`, `positionCadre`, `numPlateau`, `largeur`, `hauteur`,`commentaire`, `date`,`type_idType`)
          VALUES ('0', '$numCadre', '0', '$numPlateau', '$largeur', '$hauteur','$cmt','$dateAjout','$idType')";

  $addPlat=$db->query($query);
  echo "succes";
  header('Location: http://localhost/SafetyGlassProject/gestion/addpage.php');
}catch(PDOException $e){
  echo $addPlat . "<br>" . $e->getMessage();
} 
?>
