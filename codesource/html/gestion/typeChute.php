<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
require '../dbConnect.php';
/* requete sql pour afficher les types de chutes */

$sql="SELECT idType, nomType FROM DB_Pyrobel.type";

// SQL pour les types
$resulttype=$db->query($sql);

//SQL pour les sous types avec le type selectionné
//$resultsoustype=$db->query($sqlstype);

//foreach ($resulttype as $row){
   /* echo "<p>".$row['idTypeChute']. "\t";
    echo $row['nomTypeChute']. "\t </p>";*/
    //$group=$row['nomTypeChute'];

    $sqlstfamille="SELECT idSousFamille_Type, CONCAT (nomType,' - ',nomSousFamilleType) as nomStype
    FROM DB_Pyrobel.sousfamille_type INNER JOIN DB_Pyrobel.type
    ON idTypeChute = fk_typeChute";

    $sqlstype="SELECT idFammille_Type, nomFammille_Type FROM DB_Pyrobel.fammille_type;";
    $resultsoustype=$db->query($sqlstype);
/*
    echo " <label for=\"typeChoice".$row['idTypeChute']."\">".$row['nomTypeChute']."</label>
            <input type='radio' name='typechute' value=".$row['nomTypeChute']." required>";*/

    echo "<select class=\"form-control\" id='typechute' name='stype' size='1'>
            <option name='sousType' value='' disabled selected hidden>Selectionner un type...</option>";
    foreach ($resultsoustype as $item){
        echo " <option name='sousType' value=".$item['idFammille_Type']." id=".$item['idFammille_Type'].">".$item['nomFammille_Type']."</option>";
    }
    echo "</select>";
//}
