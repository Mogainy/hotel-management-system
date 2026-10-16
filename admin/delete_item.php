<?php

session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role']!='admin'
){
header("Location: ../login.php");
exit;
}

require '../config/db.php';

if(isset($_GET['id'])){

$id=(int)$_GET['id'];

mysqli_query(
$conn,
"DELETE FROM menu_items
WHERE item_id='$id'"
);

}

header("Location: menu_items.php");
exit;