<?php
/**
 * Created by PhpStorm.
 * User: dates
 * Date: 1/9/2016
 * Time: 2:53 AM
 */
include_once 'functions.php';
sec_session_start();

//unset all session values
$_SESSION = array();
$params = session_get_cookie_params();

//Delete the actual cookie
setcookie(session_name(), '', time()-42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]);

//Destroy session
session_destroy();
header('Location: ../Farmers%20stock/farmers_stock.php');
?>