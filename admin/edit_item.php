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

if(!isset($_GET['id'])){
die("Item not found");
}

$id = (int)$_GET['id'];

$item = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM menu_items
WHERE item_id='$id'"
)
);

if(!$item){
die("Item not found");
}

if(isset($_POST['update'])){

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

$imageName = $item['image'];

if(
isset($_FILES['image'])
&&
$_FILES['image']['error']==0
){

$imageName =
time().'_'.$_FILES['image']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../assets/images/".$imageName
);

}

mysqli_query(
$conn,
"UPDATE menu_items SET

item_name='$name',
description='$description',
price='$price',
status='$status',
image='$imageName'

WHERE item_id='$id'"
);

header("Location: menu_items.php");
exit;

}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Edit Menu Item</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:15px;
}

.preview{
width:180px;
height:180px;
object-fit:cover;
border-radius:10px;
border:1px solid #ddd;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
✏ Edit Menu Item
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
value="<?php echo $item['item_name']; ?>"
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
required><?php echo $item['description']; ?></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Price

</label>

<input
type="number"
name="price"
class="form-control"
value="<?php echo $item['price']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option
value="available"
<?php
if($item['status']=="available")
echo "selected";
?>>

Available

</option>

<option
value="unavailable"
<?php
if($item['status']=="unavailable")
echo "selected";
?>>

Unavailable

</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Current Image

</label>

<br>

<img
id="preview"

src="../assets/images/<?php echo $item['image']; ?>"

class="preview">

</div>

<div class="mb-3">

<label class="form-label">

Replace Image

</label>

<input
type="file"
name="image"
class="form-control"
accept="image/*"
onchange="loadPreview(event)">

</div>

<div class="d-flex justify-content-between">

<a
href="menu_items.php"
class="btn btn-secondary">

⬅ Back

</a>

<button
type="submit"
name="update"
class="btn btn-primary">

💾 Update Item

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function loadPreview(event){

document.getElementById('preview').src =
URL.createObjectURL(
event.target.files[0]
);

}

</script>

</body>
</html>