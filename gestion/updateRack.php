<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
session_start();
include 'secure.php';

require '../dbConnect.php';

/*
UPDATE table
SET nom_colonne_1 = 'nouvelle valeur'
WHERE condition
    => $_GET['modifRack']
*/
$oldracknumber=$_SESSION['oldrack'];
echo "<br>- Old rack n° : ".$oldracknumber.".<br>";

$rack=$_GET['listerack'];
echo "- New rack n° : ".$rack;
echo "<br>- idChute n° : ";
$id=$_SESSION['idChutte'];
echo $id."<br>";

function updatePos($empnumber,$db,$id){
  // update position Chute
  // query pour afficher la posiiton de la chute
  $position="SELECT idChutte, positionEmp FROM DB_Pyrobel.listechutte WHERE emplacement_idEmplacement = $empnumber and deleted != '1'";
  $positionchute=$db->query($position);

  // query pour afficher l'ordre en se basant sur la quantite max
  $quantite="SELECT count(*) as nb FROM DB_Pyrobel.listechutte WHERE emplacement_idEmplacement = $empnumber and deleted != '1' GROUP BY emplacement_idEmplacement;";
  $total=$db->query($quantite);

  foreach ($total as $key) {
    $_SESSION['quantite']=$key['nb'];
    echo " - Quantité : ".$_SESSION['quantite']."<br>";
  }

  $total=$_SESSION['quantite'];
  for ($i = 1; $i <= $total; $i++) {

    foreach ($positionchute as $key) {
      $pos=$key['positionEmp'];
      $id=$key['idChutte'];

      echo " <br> - idChute : ".$id." - Position : ".$pos;

    }
    echo "<br> >New position :".$i;

    try {
      $queryupdate="UPDATE `DB_Pyrobel`.`listechutte` SET `positionEmp` = '$i' WHERE (`idChutte` = '$id');";
      //update position
      $updated=$db->query($queryupdate);
    } catch (\Exception $e) {
      echo $updated . "<br>" . $e->getMessage();
    }

  }
  echo "<br> - Total : ".$total."<br>";
}



try {
  $query="SELECT idEmplacement FROM DB_Pyrobel.emplacement WHERE rack_idRack = '$rack'";
  $updaterack=$db->query($query);

  foreach ($updaterack as $key) {
    $emp=$key['idEmplacement'];
    echo "<br> - Emp n° : ". $emp."<br>";

    try {
      //update emplacement - rack
      $up="UPDATE `DB_Pyrobel`.`listechutte` SET `emplacement_idEmplacement` = '$emp' WHERE `idChutte` = '$id'";
      $modifrack=$db->query($up);

      //function ....
      updatePos($emp,$db,$id);
      updatePos($oldracknumber,$db,$id);

      header('Location: http://localhost/SafetyGlassProject/gestion/deplacement.php');
    } catch (\Exception $e) {
      echo $e->getMessage();
    }


  }

} catch (\Exception $e) {
  echo $e->getMessage();
}
