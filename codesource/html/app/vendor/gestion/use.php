<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 16:14
 */
session_start();

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
    <form action="add.php" method="get">
        <fieldset>
            <legend>Volume à couper</legend>
            <!-- <div>
                 <label>Numéro chute :</label>
                 <input type="text" id="num" name="numChute" required>
             </div> -->
            <div class="form-group">
                <label for="hauteurchute">Hauteur :</label>
                <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="3210" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="largeurchute">Largeur :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="2250" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="hauteurchute">X0 :</label>
                <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="3210" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="largeurchute">Y0 :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="2250" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="hauteurchute">X1 :</label>
                <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="3210" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label for="largeurchute">Y1 :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="2250" step="1" placeholder="valeur en mm" required>
            </div>
            <div class="form-group">
                <label>Commentaire :</label>
                <textarea class="form-control" rows="4" cols="70" id="comment" name="comment" placeholder="Votre commentaire ici..."></textarea>
            </div>
            <!-- dois se faire automatiquement -->
            <!--<div>
                <label>Emplacement dans le rack : </label>
                <input type="number" id="position" name="positionRack" required min="1">
            </div>-->
            <div class="boutonsubmit">
                <button type="submit" class="btn btn-primary">Couper le volume</button>
            </div>
        </fieldset>
    </form>
</main>
<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
