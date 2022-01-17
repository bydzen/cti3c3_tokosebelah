<?php 
 
include 'database/config.php';
 
error_reporting(0);
 
session_start();
 
 
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    $name1 = addslashes($name);
    $email1 = addslashes($email);
    $message1 = addslashes($message);
    
    

            $sql = "INSERT INTO feedback (name, email, pesan)
                    VALUES ('$name1', '$email1', '$message1')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Terimakasih sudah menghubungi kami')</script>";
                $name1 = "";
                $email1 = "";
                $message = "";
                echo "<script>document.location.href = 'contact.php';</script>";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                echo "<script>document.location.href = 'contact.php';</script>";
            }
        
         

}
 