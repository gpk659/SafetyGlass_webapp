<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
session_start();
session_unset();
session_destroy();

header('Location: http://localhost/SafetyGlassProject/index.php');
exit();
