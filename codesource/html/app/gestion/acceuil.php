<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
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
<hr />




<?php
if($_SESSION['pseudo'] == "admin"){
  echo '<h4 class="titlelog">Session variables currently set :</h4>';

  echo '<pre>' . print_r($_SESSION, TRUE);
  echo "$ _GET :".print_r($_GET)."<br>";
  echo "$ _GET".print_r($_POST). '</pre>';

}



 include_once 'footer.php'; ?>
</body>
</html>
