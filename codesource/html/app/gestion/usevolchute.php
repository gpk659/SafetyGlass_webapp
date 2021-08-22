 <?php

require '../dbConnect.php';
session_start();

$id=$_GET['idChutte'];
$idVol=$_GET['idVol'];
$ht=$_GET['ht'];
$lg=$_GET['lg'];
$date=$_GET['date'];
$cmt=$_GET['cmt'];
$numcom=$_GET['numcom'];
$lettre=$_GET['lettre'];
$hfab=$_GET['hfab'];
$datefab=$_GET['dfab'];

echo $id;

try {
	$queryparam="SELECT plateau_idPlateau as plat, lc.type_idType as type, numPlateau, codeAGCType
				FROM DB_Pyrobel.listechutte as lc, DB_Pyrobel.plateau as p, DB_Pyrobel.type as t
				where
				lc.plateau_idPlateau = p.idPlateau and lc.type_idType = t.idType and
				idChutte = ".$id;
	$listparam=$db->query($queryparam);

	foreach ($listparam as $param){
		$_SESSION['platChutte'] = $param['plat'];
		$_SESSION['typeChute'] = $param['type'];
		$_SESSION['numPlateau'] = $param['numPlateau'];
		$_SESSION['codeAGCType'] = $param['codeAGCType'];
	}

    $newVolBon="INSERT INTO `DB_Pyrobel`.`listevolumesbons` (`numCom`, `lettre`, `numVol`, `largeur`, `hauteur`, `X0`, `Y0`, `dateFabrication`, `heureFabrication`, `commentaire`, `typeverre`,`plateau_idPlateau`,`listechutte_idChutte`,`listeoperateur_idOperateur`)
                                                            VALUES ('".$numcom."', '".$lettre."', '".$idVol."', '".$ht."', '".$lg."', '0', '0', '".$datefab."', '".$hfab."', 'fait', '".$_SESSION['codeAGCType']."', '".$_SESSION['platChutte']."','".$id."','".$_SESSION['id']."');";
    echo "<br>".$newVolBon."<br>";
    $queryVolFait=$db->query($newVolBon);

	$queryVolFait=$db->query($newVolBon);


  $deleteloss="UPDATE `DB_Pyrobel`.`listechutte` SET `deleted` = '1' WHERE (`idChutte` = '".$id."')";
  //echo $deleteloss;
  $editloss=$db->query($deleteloss);

  $deleteVol="UPDATE `DB_Pyrobel`.`listevolume` SET `deleted` = '1' WHERE (`idListeVolume` = '$idVol');";
  $editVol=$db->query($deleteVol);

  echo "...suppression chute...suppression volume...";
}catch(PDOException $e){
  echo "<br>" . $e->getMessage();
}

?>



<script>
var message = confirm("Est-ce qu'il y a encore une chute ?");
if( message == true ) {
   console.log("ajout d'une chute");
} else if(message == false) {
   console.log("pas de chutes restantes");
}

</script>
