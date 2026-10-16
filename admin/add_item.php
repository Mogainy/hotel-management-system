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

if(isset($_POST['save'])){

    $name = mysqli_real_escape_string(
        $conn,
        $_POST['item_name']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $price = $_POST['price'];

    $status = $_POST['status'];

    $imageName = "";

    if(isset($_FILES['image']) &&
       $_FILES['image']['error']==0){

        $imageName =
        time()."_".$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/".$imageName
        );
    }

    mysqli_query(
        $conn,
        "INSERT INTO menu_items
        (
        item_name,
        description,
        price,
        status,
        image
        )
        VALUES
        (
        '$name',
        '$description',
        '$price',
        '$status',
        '$imageName'
        )"
    );

    header("Location: menu_items.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Menu Item</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:15px;
}

.preview{
width:150px;
height:150px;
object-fit:cover;
border-radius:10px;
display:none;
margin-top:10px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4 class="mb-0">
➕ Add New Menu Item
</h4>

</div>

<div class="card-body">

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">

Food / Drink Name

</label>

<input
type="text"
name="item_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Price (KES)

</label>

<input
type="number"
name="price"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="available">
Available
</option>

<option value="unavailable">
Unavailable
</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Food Image

</label>

<input
type="file"
name="image"
class="form-control"
accept="image/*"
onchange="previewImage(event)">

<img
id="preview"
class="preview">

</div>

<div class="d-flex justify-content-between">

<a
href="menu_items.php"
class="btn btn-secondary">

⬅ Back

</a>

<button
type="submit"
name="save"
class="btn btn-success">

💾 Save Item

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function previewImage(event){

var preview =
document.getElementById('preview');

preview.src =
URL.createObjectURL(
event.target.files[0]
);

preview.style.display='block';

}

</script>

</body>
</html>