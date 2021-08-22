<?php

require '../dbConnect.php';


try {
  $nb = 1;
  $qte = $_POST['quantite'];

    while($nb <= $qte){
      $numCom=$_POST['numCom'];
      $lettre=$_POST['lettre'];
      $qte=$_POST['quantite'];
      $largeur=$_POST['largeur'];
      $hauteur=$_POST['hauteur'];
      $fac=$_POST['faconnage'];
      $cmt=$_POST['comment'];
      $date=$_POST['datelivraison'];
      $type=$_POST['stype'];

      $newVol="INSERT INTO `DB_Pyrobel`.`listevolume` (`numCom`, `lettre`, `x`, `nnn`, `datelivraison`, `typeverre`, `largeur`, `hauteur`, `faconnage`, `commentaire`)
      VALUES ('$numCom', '$lettre', '$qte', '$nb', '$date', '$type', '$largeur', '$hauteur', '$fac', '$cmt')";

      $nb++;
      $addVol=$db->query($newVol);
        echo "succes";
        header('Location: http://localhost/SafetyGlassProject/gestion/listvolume.php');
      }
    }catch(PDOException $e){
      echo $addVol . "<br>" . $e->getMessage();
    }
?>
