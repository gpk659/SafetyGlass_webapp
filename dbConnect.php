<?php
  try {

      $db = new PDO('mysql:host=localhost;dbname=DB_Pyrobel', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
      echo 'sucess';
  }
  catch (Exception $e)
  {
      return ["PDOException"=>$e->getMessage()];
  }
?>
