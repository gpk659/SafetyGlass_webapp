<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 16:15
 */
session_start();
require '../dbConnect.php';
include 'secure.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */ include_once ("menu.php"); ?>
<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<main>
    <div id="addUser" class="tabcontentPrint">
        <form method="get" action="print.php" >
            <fieldset>
                <legend>Recherche</legend>

                <label class="labelchute">Dimensions : </label>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" type="number" name="hauteur" placeholder="hauteur chute">
                    </div>
                    <div class="col">
                        <input class="form-control" type="number" name="largeur" placeholder="largeur chute">
                    </div>
                </div>
                <div class="form-group">
                    <label class="labelchute">Rack : </label>
                    <input class="form-control" type="text" name="rack" placeholder="numéro rack">
                </div>
                <div class="form-group">
                    <label class="labelchute">Type chute :</label>
                    <?php include 'typeChute.php'; ?>
                </div>
                <div class="boutonsubmit">
                    <input type="submit" class="btn btn-primary" value="Rechercher">
                </div>

            </fieldset>
        </form>
    </div>

    <h4 class="listechute">Etiquette</h4>

    <?php
        if(isset($_GET['hauteur']) || isset($_GET['rack'])) {
            $hauteur = $_GET['hauteur'];
            $largeur = $_GET['largeur'];
            $rack = $_GET['rack'];
            $typechute = $_GET['stype'];

            $sql = "SELECT nomChute, hauteur, largeur, numLot, dateChute, numRack, nomEmplacement, nomTypeChute, nomSousTypeChute, positionEmplacement, idSousTypeChute
               FROM  DB_Pyrobel.placement as p,
                      DB_Pyrobel.emplacement as e,
                      DB_Pyrobel.rack as r,
                      DB_Pyrobel.emplacementUsine as eu,
                      DB_Pyrobel.chute as c,
                      DB_Pyrobel.type as t,
                      DB_Pyrobel.soustypechute as stc,
                      DB_Pyrobel.typechute as tc

                where  p.emplacement_idEmplacement = e.idEmplacement
                   and p.rack_idRack = r.idRack
                   and p.emplacementusine_idEmplacementUsine = eu.idEmplacementUsine
                   and c.fk_placement = p.idPlacement
                   and c.type_idType = t.idType
                   and t.sousTypeChute_idSousTypeChute = stc.idSousTypeChute
                   and t.typeChute_idTypeChute = tc.idTypeChute
                   and ((numRack = '".$rack."') or (hauteur = '".$hauteur."') or (largeur='".$largeur."') or (idSousTypeChute='".$typechute."'))
                order by dateChute";

            $listChute = $db->query($sql);
            $count = $listChute->rowCount();

            foreach ($listChute as $row) {
                if ($count == 0) { echo"<p style='color:red'>Aucun résultat</p>";}
                else if ($_GET['hauteur'] == $row['hauteur'] || $_GET['largeur'] == $row['largeur'] || $_GET['rack'] == $row['numRack'] || $_GET['stype'] == $row['idSousTypeChute'] ){
                    echo "<div class='etiquette'>
                                <p>" . $row['nomChute'] . "</p>
                                <p>" . $row['hauteur'] . "*" . $row['largeur'] . " (H*L)</p>
                                <p>" . $row['numLot'] . "</p>
                                <p>" . $row['nomEmplacement'] . "</p>
                                <p>" . $row['nomTypeChute'] . "  " . $row['nomSousTypeChute'] . "</p>
                           </div>";
                }else {
                    echo "<p style='color:red'>error</p>";
                }
            }//echo "nb lignes : ".$count;
        }
    ?>
</main>
<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
