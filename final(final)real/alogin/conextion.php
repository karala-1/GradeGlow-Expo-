<?php

$host = 'localhost';
$user = 'root'; 
$password = ''; 
$database = 'glow'; 


$con = mysqli_connect($host, $user, $password, $database);


if (!$con) {
    die("Conexion fallida: " . mysqli_connect_error());
}
