<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 25-09-18
 * Time: 11:45
 */

require '../../dbConnect.php';

if(empty($_POST['username']) && empty($_POST['password'])){
    echo "Les champs sont vides!";
}else if($_POST['password'] == $_POST['password_conf']) {
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $droit = $_POST['droit'];

    try{
        $sqlAddUser = "INSERT INTO DB_Pyrobel.user (`name`, `password`, `nivdroit`)
                       VALUES ('$username', '$password','$droit')";

        $insertUser = $db->query($sqlAddUser);
        header('Location: http://localhost/SafetyGlassProject/gestion/addpage.php');
    }catch (PDOException $e){
        echo $sqlAddUser. "<br>". $e->getMessage();
    }
}else{
    echo "<p>Les mots de passes ne sont pas identiques.</p><li><a href='../addpage.php' id=\"acceuil\">Retour</a></li>";
}
