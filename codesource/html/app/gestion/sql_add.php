<?php
/**
 * User: Grégory
 */
session_start();
 include 'head.inc.php';
require '../dbConnect.php';

$idUser=$_SESSION['id'];
$hauteur=$_GET['hauteurChute'];
$largeur=$_GET['largeurChute'];
$day=date("Y-m-d");

$comment=$_GET['comment'];

$emp=$_GET['listerack'];


	if(isset($_SESSION['platChutte'])){

		$plateau=$_SESSION['platChutte'];
	}else{
		$plateau=$_GET['plateau'];
	}

	if(isset($_SESSION['typeChute'])){
		$type=$_SESSION['typeChute'];
	}else{
		$type=$_GET['stype'];
	}

try {

  $countChutte="SELECT count(*)+1 as NB FROM `DB_Pyrobel`.`listechutte` WHERE emplacement_idEmplacement = '$emp'";
  $queryCount = $db->query($countChutte);
  foreach ($queryCount as $key) {
    $nb=$key['NB'];



  $insertloss="INSERT INTO `DB_Pyrobel`.`listechutte` (`largeur`, `hauteur`, `dateMiseStock`,`commentaire`, `positionEmp`, `plateau_idPlateau`, `listeoperateur_idOperateur`,`emplacement_idEmplacement`, `type_idType`, `deleted`)

  VALUES ('".$largeur."','".$hauteur."','".$day."','".$comment."','$nb','".$plateau."','".$idUser."','".$emp."','".$type."','0')";
  //echo $insertloss;
  $addloss=$db->query($insertloss);
  //echo "succes";
  //echo $insertloss;
  }
try {
  $sqllastentry="SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, numPlateau, descriptionCourte as type, date,  listchutte.commentaire as cmt
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and listchutte.type_idType = type.idType
                    ORDER BY idChutte DESC LIMIT 1";

  $printloss=$db->query($sqllastentry);
  foreach ($printloss as $key) {
    $idchutte=$key['idChutte'];
    $hauteur=$key['ht'];
    $largeur=$key['lg'];
    $plateau=$key['numPlateau'];
    $type=$key['type'];
    $date=date("d-m-Y", strtotime($key['date']));
    $cmt=$key['cmt'];

    echo "<div id=printbox class='printarea'>";

    echo "<p class='firstline'><span class='date'>$date</span><br><span>N° : </span><span class='number'>$idchutte</span></p>";
    echo "<p><span>Type : </span><br><p class='item2'>$type</p></p>";
    echo "<p><span>Dimensions : </span><p class='item2'>$largeur X $hauteur</p> </p>";
    echo "<p class='item'><span>Plateau : </span><span>$plateau</span></p>";
    echo "<p><span>Commentaire :</span><p class='item2'>$cmt</p></p>";

    echo "</div>";
  }
  echo "<a href='http://localhost/SafetyGlassProject/gestion/acceuil.php'> >RETOUR</>";


}catch(PDOException $e){
  echo "<br>" . $e->getMessage();
  echo $insertloss;
}
?>
<script>
  printContent('printbox');

  function printContent(el){
   var restorepage = document.body.innerHTML;
   var printcontent = document.getElementById(el).innerHTML;
   document.body.innerHTML = printcontent;
   window.print();
   document.body.innerHTML = restorepage;
  }



</script> <?php
  //header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
  exit();
}catch(PDOException $e){
  echo "<br>" . $e->getMessage();
  echo "<pre>".$insertloss."</pre>";
}
