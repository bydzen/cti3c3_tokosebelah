<?php 
 
include '../database/config.php';
 
error_reporting(0);
 
session_start();
 
 
if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);


    $firstname1 = addslashes($firstname);
    $lastname1 = addslashes($lastname);
    $username1 = addslashes($username);
    $email1 = addslashes($email);
    
    
        $sql = "SELECT * FROM user WHERE username='$username1'";
        $sql2 = "SELECT * FROM user WHERE email='$email1'";
        $result2 = mysqli_query($conn, $sql2);
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0 && !$result2->num_rows > 0) {
            $sql = "INSERT INTO user (firstname, lastname, username, email, password)
                    VALUES ('$firstname1', '$lastname1', '$username1', '$email1', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('registrasi berhasil!')</script>";
                $firstname1 = "";
                $lastname1 = "";
                $username1 = "";
                $email1 = "";
                $_POST['password'] = "";
                echo "<script>document.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                echo "<script>document.location.href = 'register.php';</script>";
            }
        } else {
            echo "<script>alert('Woops! Email dan Username Sudah Terdaftar.')</script>";
            echo "<script>document.location.href = 'register.php';</script>";
        }
         

}
 