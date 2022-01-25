<?php 
 
$server = "localhost";
$user = "u1088206_utokosebelah";
$pass = "tokosebelah";
$database = "u1088206_tokosebelah";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

?>