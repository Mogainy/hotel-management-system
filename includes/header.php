<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tracer Hotel System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    min-height:100vh;
    background:#1f2937;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:12px;
}

.sidebar a:hover{
    background:#374151;
}

.card-shadow{
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

</style>

</head>

<body>