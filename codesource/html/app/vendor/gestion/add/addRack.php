<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 25-09-18
 * Time: 11:45
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

try {
    $sqlAddRack = "INSERT INTO `DB_Pyrobel`.`rack` (`abreviation`, `nomRack`, `description`, `largeur`, `longueur`, `X0`, `Y0`, `zone_idZone`)
                   VALUES ('$abrev','$nomRack','$desc','$largeur','$longeur','$xo','$yo','$listZone')";


    $inserRack = $db->query($sqlAddRack);
    echo "success";
    header('Location: http://localhost/SafetyGlassProject/gestion/newloss.php');
}catch (PDOException $e){
    echo $inserRack. "<br>". $e->getMessage();
}
?>
