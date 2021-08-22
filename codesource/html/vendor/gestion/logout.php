<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 04-09-18
 * Time: 17:04
 */
session_start();
session_unset();
session_destroy();

header('Location: http://localhost/SafetyGlassProject/index.php');
exit();