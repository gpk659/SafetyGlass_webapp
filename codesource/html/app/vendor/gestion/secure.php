<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 26-09-18
 * Time: 16:37
 */

if(empty($_SESSION)){
    header('Location: http://localhost/SafetyGlassProject/index.php');
}