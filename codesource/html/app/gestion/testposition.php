<?php
require '../dbConnect.php';
session_start();

// query pour afficher la posiiton de la chute
$position="SELECT idChutte, positionEmp
           FROM DB_Pyrobel.listechutte
           WHERE emplacement_idEmplacement = 21 and deleted != '1'";
$positionchute=$db->query($position);

// query pour afficher l'ordre en se basant sur la quantite max
$quantite="SELECT count(*) as nb
                               FROM DB_Pyrobel.listechutte
                               WHERE emplacement_idEmplacement = 21 and deleted != '1'
                               GROUP BY emplacement_idEmplacement;";
$total=$db->query($quantite);
foreach ($total as $key) {
  $_SESSION['quantite']=$key['nb'];
  echo "Quantité : ".$_SESSION['quantite']."<br>";
}

$total=$_SESSION['quantite'];
            for ($i = 1; $i <= $total; $i++) {

              foreach ($positionchute as $key) {
                $pos=$key['positionEmp'];
                $id=$key['idChutte'];

                echo " <br>idChute : ".$id." - Position : ".$pos;

              }
              echo "<br> >New position :".$i;

              try {
                $queryupdate="UPDATE `DB_Pyrobel`.`listechutte` SET `positionEmp` = '$i' WHERE (`idChutte` = '$id');";

                $updated=$db->query($queryupdate);
              } catch (\Exception $e) {
                echo $updated . "<br>" . $e->getMessage();
              }



            }
            //echo "<br>Total chute : ".$total."<br>";






 ?>
