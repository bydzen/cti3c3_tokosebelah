<?php 
 
include '../database/session.php';
 
error_reporting(0);

 
if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $password = md5($_POST['password']);


    $firstname1 = addslashes($firstname);
    $lastname1 = addslashes($lastname);
    $username1 = addslashes($username);
    $email1 = addslashes($email);
    $address1 = addslashes($address);
    $no_hp1 = addslashes($no_hp);

    $image1 = $_FILES['my_image']['tmp_name'];
    $image= base64_encode(file_get_contents(addslashes($image1)));
    
    
    $sql = "UPDATE `user` SET `firstname`='$firstname1',`lastname`='$lastname1',
    `username`='$username1',`email`='$email1',`alamat`='$address1',
    `no_hp`='$no_hp',`password`='$password', `avatar`='$image' WHERE `id_user` = '$loggedin_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Update berhasil!')</script>";
        $firstname1 = "";
        $lastname1 = "";
        $username1 = "";
        $email1 = "";
        $address1 = "";
        $no_hp1 = "";
        $_POST['password'] = "";
        echo "<script>document.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
        echo "<script>document.location.href = 'profile.php';</script>";
    }
        
         

}