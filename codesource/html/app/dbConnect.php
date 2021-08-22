<?php
  try {
    $db = new PDO('mysql:host=localhost;dbname=DB_Pyrobel', 'safety', 'CychrehefOwnAid');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        //return $db;
        //echo 'sucess';
 }
  catch (Exception $e)
  {
      return $e->getMessage();
  }

?>
