<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 14:58
 */
require '../dbConnect.php';

session_start();
include 'secure.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>

<body>
<?php /* print_r($_SESSION); */
include_once "menu.php";
?>
<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<h2 style="text-align: center; text-decoration: underline; margin-bottom: 1em;">Production</h2>
<div id="chartContainer" style="height: 370px; width: 70%; margin: auto"></div>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
<script>

    <?php
        $sql="SELECT idRack, numRack, count(idRack) as nbC FROM  DB_Pyrobel.placement as p,  DB_Pyrobel.rack as r
              where p.rack_idRack = r.idRack
              group by numRack;";

        $stmt=$db->prepare($sql);
        $stmt->execute();
        $nbChutesRack=$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $nbChutesRack=$stmt->fetchAll();
    ?>

    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Racks"
            },
            axisY: {
                title: "Quantité"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Quantité de chutes/rack",
                dataPoints: [
                    <?php
                        foreach ($nbChutesRack as $row){
                            echo "{y:".$row['nbC'].", label:' ".$row['numRack']."'},";
                        }
                    ?>
                  /*  { y: 300878, label: "Venezuela" },
                    { y: 266455,  label: "Saudi" },
                    { y: 169709,  label: "Canada" },
                    { y: 158400,  label: "Iran" },
                    { y: 142503,  label: "Iraq" },
                    { y: 101500, label: "Kuwait" },
                    { y: 97800,  label: "UAE" },
                    { y: 80000,  label: "Russia" }*/
                ]
            }]
        });
        chart.render();

    }
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
