<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
session_start();

require '../../dbConnect.php';
include '../secure.php';

    $abrev = $_POST['abrev'];
    $desc = $_POST['desc'];
    $largeur = $_POST['largeur'];
    $longeur = $_POST['longeur'];
    $xo = $_POST['xo'];
    $yo = $_POST['yo'];
    $listZone = $_POST['listZone'];
    $nomRack = $_POST['nameRack'];
    $nbid;

try {
    $nbid=112+1;
    $sqlAddRack = "INSERT INTO `DB_Pyrobel`.`rack` (`idRack`,`abreviation`, `nomRack`, `description`, `largeur`, `longueur`, `X0`, `Y0`, `zone_idZone`)
                   VALUES ('$nbid','$abrev','$nomRack','$desc','$largeur','$longeur','$xo','$yo','$listZone')";


    $inserRack = $db->query($sqlAddRack);
    echo "success";
    header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
}catch (PDOException $e){
    echo "<br>". $e->getMessage();
}
?>
