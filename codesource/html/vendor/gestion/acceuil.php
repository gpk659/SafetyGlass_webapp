<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 14:58
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
  echo print_r($_GET). '</pre>';

}



 include_once 'footer.php'; ?>
</body>
</html>
