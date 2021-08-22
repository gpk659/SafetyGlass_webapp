<?php
session_start();
include 'secure.php';
include_once 'newRequests.php';

 elementNewLoss('plateau');
echo "<a href='http://localhost/SafetyGlassProject/gestion/addpage.php' target='_blank'> > Ajouter un nouveau plateau</a>";
 ?>
