<?php
session_start();
require 'config/db.php';

$error = '';

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM staff
        WHERE username='$username'"
    );

    if(mysqli_num_rows($query)>0){

        $user = mysqli_fetch_assoc($query);

        if(password_verify(
            $password,
            $user['password']
        )){

            $_SESSION['staff_id']=$user['staff_id'];
            $_SESSION['fullname']=$user['fullname'];
            $_SESSION['role']=$user['role'];

            header("Location: dashboard_redirect.php");
            exit;
        }
    }

    $error="Invalid Username or Password";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Hotel Ordering System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:Arial,sans-serif;

}

.login-card{

width:420px;

background:white;

border-radius:20px;

padding:35px;

box-shadow:0 15px 40px rgba(0,0,0,.3);

}

.logo{

font-size:60px;

text-align:center;

}

.title{

text-align:center;

font-weight:bold;

margin-top:10px;

}

.subtitle{

text-align:center;

color:gray;

margin-bottom:30px;

}

.form-control{

height:50px;

border-radius:10px;

}

.btn-login{

height:50px;

border-radius:10px;

font-size:18px;

}

.footer{

text-align:center;

margin-top:20px;

font-size:14px;

color:#666;

}

</style>

</head>

<body>

<div class="login-card">

<div class="logo">

🏨

</div>

<h2 class="title">

Boutique Hotel

</h2>

<p class="subtitle">

QR Ordering Management System

</p>

<?php
if($error){
?>

<div class="alert alert-danger">

<i class="bi bi-exclamation-circle-fill"></i>

<?php echo $error; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Username

</label>

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-person-fill"></i>

</span>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter Username"
required>

</div>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-lock-fill"></i>

</span>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

</div>

<button
type="submit"
name="login"
class="btn btn-success w-100 btn-login">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</form>

<div class="footer">

© <?php echo date("Y"); ?>

Boutique Hotel Ordering System

</div>

</div>

</body>

</html>