<?php
session_start();
include 'head.inc.php';

include 'secure.php';
require '../dbConnect.php';
include_once 'newRequests.php';

$chute=$_GET['chute'];

try {
  $getloss="SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, numPlateau, descriptionCourte as type, listchutte.dateMiseStock as date, listchutte.commentaire as cmt
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type as tp
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and listchutte.type_idType = tp.idType
                    and idChutte = $chute";

  $printloss=$db->query($getloss);

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
  //echo "succes";

  echo "<a href='http://localhost/SafetyGlassProject/gestion/acceuil.php'> >RETOUR</>";


  //header('Location: http://localhost/SafetyGlassProject/gestion/deplacement.php');

}catch(PDOException $e){
  echo $getloss . "<br>" . $e->getMessage();
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
 </script>
