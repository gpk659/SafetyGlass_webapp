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

    $nomType = $_POST['nomType'];
    $epType = $_POST['epType'];
    $masseType = $_POST['masseType'];
    $codeAGCType = $_POST['codeAGCType'];
    $sousFamille = $_POST['sousFamille'];
    $descourte = $_POST['desc'];
    $descomp = $_POST['descc'];


    try {
        $sqlAddType = "INSERT INTO `DB_Pyrobel`.`type` (`nomType`, `epType`, `masseType`, `codeAGCType`, `sousfamille_type_idSousFamille_Type`, `descriptionCourte`, `descriptionComplete`)
                       VALUES ('$nomType','$epType','$masseType','$codeAGCType','$sousFamille','$descourte','$descourte')";

        $inserType = $db->query($sqlAddType);
        echo "success";
        header('Location: http://localhost/SafetyGlassProject/gestion/addpage.php');
    }catch (PDOException $e){
        echo $sqlAddType. "<br>". $e->getMessage();
    }
?>
