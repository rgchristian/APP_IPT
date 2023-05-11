<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['verified_user_id']))
{
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (FailedToVerifyToken $e) {
        
        $_SESSION['expiry_status'] = "Token expired please login again";
        header('Location: logout.php');
        exit();
    } catch (\InvalidArgumentException $e) {
        echo 'The token could not be parsed: '.$e->getMessage();
        $_SESSION['expiry_status'] = "Token expired please login again";
        header('Location: logout.php');
        exit();
    }
}
else
{
    $_SESSION['status'] = "Login to access this page";
    header('Location: login.php');
    exit();
}

?>