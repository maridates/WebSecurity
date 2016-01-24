<?php
/**
 * Created by PhpStorm.
 * User: Mary
 * Date: 1/8/2016
 * Time: 10:39 AM
 */
include_once 'pls-config.php';
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id(true); // regenerated the session, delete the old one.

    $time = $_SERVER['REQUEST_TIME'];
    /**
     * for a 10 minute timeout, specified in seconds
     */
    $timeout_duration = 600;

    /**
     * Here we look for the user’s LAST_ACTIVITY timestamp. If
     * it’s set and indicates our $timeout_duration has passed,
     * blow away any previous $_SESSION data and start a new one.
     */
    if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        session_unset();
        session_destroy();
        session_start();
    }

    /**
     * Finally, update LAST_ACTIVITY so that our timeout
     * is based on it and not the user’s login time.
     */
    $_SESSION['LAST_ACTIVITY'] = $time;
}

function logout() {
    $params = session_get_cookie_params();
    //Delete the actual cookie
    setcookie(session_name(), '', time()-42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    session_unset();
    session_destroy();
    session_start();
    print "<meta http-equiv='refresh' content='0;url=farmers_stock.php'>";
}
?>