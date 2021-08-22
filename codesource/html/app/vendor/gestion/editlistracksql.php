<?php

require '../dbConnect.php';


$idrack=$_GET['idr'];
$abv=$_GET['abv'];
$nomRack=$_GET['rackname'];
$des=$_GET['des'];
$lg=$_GET['longueur'];
$lrg=$_GET['largeur'];

try {
  $queryrack="UPDATE `DB_Pyrobel`.`rack` SET `abreviation` = '$abv', `nomRack` = '$nomRack', `description` = '$des', `largeur` = '$lrg', `longueur` = '$lg'
              WHERE (`idRack` = '$idrack')";
echo $queryrack;
  $modifrack=$db->query($queryrack);
  echo "succes";

}catch(PDOException $e){
  echo $modifrack . "<br>" . $e->getMessage();
}

//header('Location: http://localhost/SafetyGlassProject/gestion/modification.php');
exit();
 ?>
