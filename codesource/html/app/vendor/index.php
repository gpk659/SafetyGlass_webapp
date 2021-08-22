<?php
  /**
   * User: Grégory
   * Date: 03-09-18
   * Time: 11:56
   */
  require 'dbConnect.php';
  session_start();
  $message ='';

  if(isset($_SESSION["pseudo"])){header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');}

  $sql='SELECT name FROM DB_Pyrobel.user';

  $listUser=$db->query($sql);

  if($_POST) //On check le mot de passe
  {
      $query=$db->prepare('SELECT iduser, name, password,nivdroit
          FROM DB_Pyrobel.user WHERE name = :pseudo');
      $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
      $query->execute();
      $data=$query->fetch();
      if ($data['password'] == $_POST['password']) /* Acces OK ! */ {

          $_SESSION['pseudo'] = $data['name'];
          $_SESSION['id'] = $data['iduser'];
          $_SESSION['droit']= $data['nivdroit'];

          try {
            // insertion date, heure de la dernier Connexion
            $lastTimeLogin = date('h:i:s-j/m/y');
            $sqlUpdate="UPDATE `DB_Pyrobel`.`user` SET `dateLastLogin` = '$lastTimeLogin' WHERE (`iduser` = '".$_SESSION['id']."')";
            $stmt=$db->query($sqlUpdate);
            $stmt->execute();
          }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
          }
          //redirection vers la page d'acceuil
          header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');
          exit();

      }else if($data['password'] != $_POST['password']) /* Acces pas OK ! */ {
        $message = '<p class="errorlogin">Une erreur s\'est produite pendant votre identification.<br /> Le mot de passe entré n\'est pas correct !'; //message mdp incorrectt
      }else {
        $message = '<p class="errorlogin">Error!</p>';
      }

      $query->CloseCursor();
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Safety Glass Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="IMG/png" href="IMG/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="CSS/util.css">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" method="post" action="index.php">
					<span class="login100-form-title p-b-70">
						Connexion
					</span>
                <span class="login100-form-avatar">
						<img src="IMG/banner.png" alt="AVATAR">
                </span>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
                    <!--<input class="input100" type="text" name="pseudo">-->
                    <?php
                        echo "<select name='pseudo' class=\"input100\" size='1'>";
                        echo "<option name='pseudo' value='' disabled selected hidden> Sélectionner un opérateur... </option>";
                            foreach ($listUser as $item){ echo "<option name='pseudo' value='".$item['name']."' id='".$item['idUser']."'>".$item['name']."</option>";}
                        echo "</select>";
                    ?>
                </div>
                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input class="input100" type="password" name="password" required>
                    <span class="focus-input100" data-placeholder="Mot de passe"></span>
                </div>
                <div>
                    <?php echo $message; ?>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Se connecter
                    </button>
                </div>
                </ul>
            </form>
        </div>
    </div>
</div>
<footer>
    <span class="credit">V. 1.0 - © P. G.</span>
</footer>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
