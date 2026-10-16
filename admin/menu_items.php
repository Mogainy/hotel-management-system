<?php

session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role'] != 'admin'
){
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Menu Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f6f9;
}

.card{
    border:none;
    border-radius:15px;
}

.table td,
.table th{
    vertical-align:middle;
}

.food-image{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
}

.page-title{
    font-weight:700;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="page-title">
🍽 Menu Management
</h2>

<p class="text-muted mb-0">
Manage hotel food and drinks
</p>

</div>

<div>

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="bi bi-house-fill"></i>
Dashboard

</a>

<a
href="add_item.php"
class="btn btn-success">

<i class="bi bi-plus-circle-fill"></i>
Add New Item

</a>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h5 class="mb-0">
📋 Menu Items
</h5>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-striped table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Status</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php

$items = mysqli_query(
$conn,
"SELECT * FROM menu_items ORDER BY item_id DESC"
);

while($row = mysqli_fetch_assoc($items)){

$image =
!empty($row['image'])
?
"../assets/images/".$row['image']
:
"../assets/images/default_food.jpg";

?>

<tr>

<td>

<?php echo $row['item_id']; ?>

</td>

<td>

<img
src="<?php echo $image; ?>"
class="food-image">

</td>

<td>

<b>

<?php echo $row['item_name']; ?>

</b>

</td>

<td>

KES <?php echo number_format($row['price']); ?>

</td>

<td>

<?php

if($row['status']=="available"){
?>

<span class="badge bg-success">

Available

</span>

<?php
}else{
?>

<span class="badge bg-danger">

Unavailable

</span>

<?php } ?>

</td>

<td>

<a
href="edit_item.php?id=<?php echo $row['item_id']; ?>"
class="btn btn-primary btn-sm">

<i class="bi bi-pencil-square"></i>
Edit

</a>

<a
href="delete_item.php?id=<?php echo $row['item_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this item?');">

<i class="bi bi-trash-fill"></i>
Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>
</html>