<?php
include('config.php');
session_start();
$user_check=$_SESSION['username'];
$ses_sql=mysqli_query($conn,"select username,id_user from user where username='$user_check'");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$loggedin_session=$row['username'];
$loggedin_id=$row['id_user'];
    if(!isset($loggedin_session) || $loggedin_session==NULL) {
        echo "Go back";
        header("Location: login.php");
    }
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
?>