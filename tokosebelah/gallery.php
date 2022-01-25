<?php
include 'Config/header.php';
include('database/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Gallery | Toko Sebelah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/gallery.css">
</head>

<body style="background-color: #22272B;">

    <!-- Gallery -->
    <div class="container-fluid" style="margin-bottom: 10%;">
        <center>
            <div class="title">Gallery</div>
            <div class="space"></div>
            <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
            <?php
            $sql = "SELECT * FROM produk ORDER BY id_produk DESC";
            $res = mysqli_query($conn,  $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($gallery = mysqli_fetch_assoc($res)) {  ?>
                    <div class="queue1">
                        <ul>
                            <li>
                                <a href="./User/addto.php?id=<?= $gallery['id_produk'] ?>"><img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($gallery['image']) . '"'; ?> alt="bag" height="200" width="200"></a>
                                <h1><?= $gallery['produk_name'] ?></h1>
                                <h3>RP. <?= number_format($gallery['price']) ?></h3>

                            </li>
                    <?php }
            } ?>
                        </ul>
                    </div>
        </center>
</body>

</html>