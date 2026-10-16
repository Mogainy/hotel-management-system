<?php
session_start();

$item_id = $_POST['item_id'];
$token = $_POST['token'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$item_id])){
    $_SESSION['cart'][$item_id]++;
}else{
    $_SESSION['cart'][$item_id] = 1;
}

header("Location: menu.php?token=".$token);
exit;
?>