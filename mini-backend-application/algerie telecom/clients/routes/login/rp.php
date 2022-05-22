<?php 
   session_start();
if(isset($_GET['q']) && $_GET['q'] == 'reset')
{
    unset($_SESSION['success']);
    $_SESSION['AUTHORIZED'] = 'authorized';
    header("Location: reset.php");
}else
{
    unset($_SESSION['AUTHORIZED']);
    unset($_SESSION['success']);
    header("Location: login.php");
}
?>