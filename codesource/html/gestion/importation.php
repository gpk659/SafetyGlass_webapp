<?php
    /**
     * Created by PhpStorm.
     * User: Grégory
     */

    session_start();
    include 'secure.php';
    require "../dbConnect.php";
    include_once 'newRequests.php';
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
<hr />
<h2>Importation fichiers excel sur la base donnée.</h2>

<?php

echo "<h5>Importation en cours...</h5><br>";
$handle = fopen("add/19,14518_B001.csv", "r");
for ($i = 0; $row = fgetcsv($handle ); ++$i) {

  echo "<pre>";
  print_r($row);
  echo "</pre>";
  echo '<br>';





  try{

  //$columns = implode(", ",array_keys($row));
  //$escaped_values = array_map('mysql_real_escape_string', array_values($row));
  $values  = "'".implode("','", $row)."'";



  $sql = "INSERT INTO DB_Pyrobel.listevolume(`numCom`,`lettre`,`x`,`nnn`,`datelivraison`,`typeverre`,`largeur`,`hauteur`,`faconnage`,`commentaire`,`chutesug`,`deleted`)
                               VALUES ($values)";
  print_r($sql);
  echo '<br>';echo '<br>';


  $insertdata = $db->query($sql);
  echo "<h6>Ligne ajouté à la base de donnée ! </h6><br>";
}catch (PDOException $e){
	echo "! ERROR !";
    echo $sql. "<br>". $e->getMessage();
}
}

fclose($handle);
?>


<?php include_once 'footer.php'; ?>
</body>
</html>
