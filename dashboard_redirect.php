<?php
session_start();

if(!isset($_SESSION['role'])){
    header("Location: login.php");
    exit;
}

switch($_SESSION['role']){

    case 'admin':
        header("Location: admin/dashboard.php");
        break;

    case 'chef':
        header("Location: chef/dashboard.php");
        break;

    case 'waiter':
        header("Location: waiter/dashboard.php");
        break;
}

exit;