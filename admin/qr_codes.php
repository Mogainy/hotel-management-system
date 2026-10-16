<?php
session_start();

if(
    !isset($_SESSION['role']) ||
    $_SESSION['role'] != 'admin'
){
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>QR Code Management</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.qr-card{
    transition:.3s;
}

.qr-card:hover{
    transform:translateY(-5px);
}

.qr-card img{
    max-width:220px;
    margin:auto;
}

@media print{

.no-print{
display:none;
}

body{
background:white;
}

}

</style>

</head>

<body>

<div class="container mt-4">
<?php
if(isset($_GET['success'])){
?>
<div class="alert alert-success alert-dismissible fade show">

✅ All QR Codes were regenerated successfully.

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>
<?php
}
?>
<div class="d-flex justify-content-between align-items-center mb-4">

<h2>🏨 Hotel QR Codes</h2>

<div>

<a
href="generate_qr.php"
class="btn btn-success no-print">

Generate QR Codes

</a>

<button
onclick="window.print()"
class="btn btn-primary no-print">

Print All

</button>

</div>

</div>

<div class="row">

<?php

$locations = mysqli_query(
$conn,
"SELECT * FROM locations ORDER BY location_name"
);

while($location = mysqli_fetch_assoc($locations)){

$qrFile = "../qrcodes/".$location['qr_token'].".png";

?>

<div class="col-md-4 mb-4">

<div class="card shadow qr-card">

<div class="card-body text-center">

<h4>

<?php echo htmlspecialchars($location['location_name']); ?>

</h4>

<hr>

<img
src="<?php echo $qrFile; ?>?v=<?php echo time(); ?>"
class="img-fluid"
alt="QR Code">

<hr>

<p>

Token:
<b><?php echo htmlspecialchars($location['qr_token']); ?></b>

</p>

<div class="d-grid gap-2 no-print">

<a
href="<?php echo $qrFile; ?>"
download
class="btn btn-success">

Download QR

</a>

<a
href="https://samhotelorder.ct.ws/hotel-ordering-system/guest/menu.php?token=<?php echo urlencode($location['qr_token']); ?>"
target="_blank"
class="btn btn-primary">

Open Menu

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>

</html>