<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 30-10-18
 * Time: 11:26
 */

require '../dbConnect.php';


echo "chute nb : ".$_GET['chute'];
$chute=$_GET['chute'];



try {
  $deleteloss="UPDATE `DB_Pyrobel`.`listechutte` SET `deleted` = '1' WHERE (`idChutte` = $chute)";
echo $deleteloss;
  $editloss=$db->query($deleteloss);
  echo "succes";

  header('Location: http://localhost/SafetyGlassProject/gestion/deplacement.php');
  exit();

}catch(PDOException $e){
  echo $editloss . "<br>" . $e->getMessage();
}
