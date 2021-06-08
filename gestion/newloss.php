<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   */
  session_start();
  include 'secure.php';
  include_once 'newRequests.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */
  include_once ("menu.php");
?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />
<main>
    <form id="formnewloss" action="sql_add.php" method="get">
        <fieldset>
            <legend id='titleform'>Ajouter une nouvelle chute</legend>
            <div class="form-group">
                <label for="hauteurcChute">Hauteur :</label>
                <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="6000" step="1" placeholder="Valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="largeurChute">Largeur :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="3210" step="1" placeholder="Valeur en mm" required>
            </div>
            <div class="form-group">
               <?php
				   if(isset($_SESSION['typeChute']) ){
					   //echo "type chute : ".$_SESSION['typeChute'];
					   $type=$_SESSION['typeChute'];
					   $typeN=$_SESSION['codeAGCType'];
					   echo '<label for="typechute">Type Chutte ('.$typeN.') :</label><input class="form-control" id="typechute" type="text" name="stype" min="1" value="'.$type.'" disabled>';
				   }else{
					   elementNewLoss('SoustypeChute');
				   }
			   ?>
            </div>
            <div id='rack' class="form-group">
                <?php elementNewLoss('rack');  ?>
            </div>
<hr>
            <div>
                <?php
				if(isset($_SESSION['platChutte'])){
					   //echo "plat : ".$_SESSION['platChutte'];
					   $plat=$_SESSION['platChutte'];
					   $platN=$_SESSION['numPlateau'];
					   echo '<label for="plateauId">Plateau ('.$platN.') :</label><input class="form-control" id="plateauId" type="text" name="plateau" min="1" value="'.$plat.'" disabled>';
				   }else{
					   echo '<div id="listingPlat" class="form-group">';
					  elementNewLoss('plateau');
					  echo "<a href='http://localhost/SafetyGlassProject/gestion/addpage.php' target='_blank'> > Ajouter un nouveau plateau</a>";
					  echo "</div>";
				   }
				?>

            </div>

            <hr>
            <div id='comment' class="form-group">
                <label>Commentaire :</label>
                <textarea class="form-control" rows="4" cols="70" id="comment" name="comment" placeholder="Votre commentaire ici..." required></textarea>
            </div>
            <!-- dois se faire automatiquement -->
            <!--<div>
                <label>Emplacement dans le rack : </label>
                <input type="number" id="position" name="positionRack" required min="1">
            </div>-->
            <div class="boutonsubmit">
                <button type="submit" class="btn btn-primary">Ajouter</button>
              <!--  <button type="button" id="printbutton" class="btn btn-primary">Imprimer</button> -->

            </div>
        </fieldset>
    </form>
</main>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

$(document).ready(function() {
  $.ajaxSetup({ cache: false }); // This part addresses an IE bug. without it, IE will only load the first number and will never refresh
  setInterval(function() {
    $('#listingPlat').load('listingPlat.php');
  }, 10000); // the "3000" here refers to the time to refresh the div. it is in milliseconds.
});
</script>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
