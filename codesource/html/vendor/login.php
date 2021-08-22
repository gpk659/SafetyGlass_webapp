<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 01-09-18
 * Time: 12:39
 */
require 'dbConnect.php';
$message='';
session_start();
//$_SESSION['pseudo'];
//$_SESSION['id'];

if(isset($_SESSION["pseudo"])){
    header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');
}
if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
{
    $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>';
}
else //On check le mot de passe
{
    $query=$db->prepare('SELECT idUser, userName, password
        FROM db_project_pyrobel.user WHERE userName = :pseudo');
    $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
    $query->execute();
    $data=$query->fetch();
    if ($data['password'] == $_POST['password']) // Acces OK !
    {
        $_SESSION['pseudo'] = $data['userName'];
        $_SESSION['id'] = $data['idUser'];
        $message = '<p>Bienvenue '.$data['userName'].',
			vous êtes maintenant connecté!</p>';

        header('Location: http://localhost/SafetyGlassProject/gestion/acceuil.php');
        exit();
    }
    else if($data['password'] != $_POST['password']) // Acces pas OK !
    {
        $message = '<p>Une erreur s\'est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.
	    <br /><br />Cliquez <a href="index.php">ici</a>
	    pour revenir à la page d accueil</p>';
        echo "<script>alert('Mot de passe et/ou pseudo incorrect')</script>";
        header('Refresh: 5; Location: http://localhost/SafetyGlassProject/index.php');
    }
    $query->CloseCursor();
}
//echo $message;

?>
