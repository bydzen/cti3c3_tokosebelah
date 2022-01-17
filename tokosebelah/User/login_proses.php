<?php 
 
include '../database/config.php';
 
error_reporting(0);
 
session_start();
 
$uname = mysqli_real_escape_string($conn, $_POST['username']);
$pass  = md5($_POST['password']);


$sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";

$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    echo "<script>document.location.href = ' home.php';</script>";
} else {
    echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    echo "<script>document.location.href = 'login.php';</script>";
}
 
?>