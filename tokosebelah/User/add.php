<?php 

if (isset($_GET['id'])) {
	include '../database/session.php';


	$id = validate($_GET['id']);
    
	validate($sql = "SELECT * FROM produk WHERE id_produk=$id");

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
    	$row = mysqli_fetch_assoc($result);
    }else {
    	header("Location: addto.php?id=$id");
    }

	
}
?>