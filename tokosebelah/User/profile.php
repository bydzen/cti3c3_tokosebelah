<?php include '../database/session.php'; ?>
<?php include '../Config/header-user.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Profile | Toko Sebelah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/profile.css">
</head>

<body style="background-color: #22272B;">
    <!-- My profile -->
    <div class="container-fluid" style="margin-bottom: 10%;">
        <?php

        $sql = "SELECT * FROM user WHERE id_user='$loggedin_id'";
        $res = mysqli_query($conn,  $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($gallery = mysqli_fetch_assoc($res)) {  ?>
                <div class="container rounded bg-black mt-5">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" <?php echo 'src="data:image;base64,' . $gallery['avatar'] . '"'; ?> width="90">
                                <span class="font-weight-bold" style="color:white;margin-top:20px;margin-bottom:20px;"><?= $gallery['username'] ?></span>
                                <span class="text-light-50" style="text-decoration:none;color:white;"><a style="text-decoration:none;color:white;" class="font-weight-bold" href="orders.php">My Order</a></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-row align-items-center back" style="color:white;"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                        <a href="logout.php" style="text-decoration:none;">
                                            <h6 style="color:white;">Logout</h6>
                                        </a>
                                    </div>
                                    <h6 class="text-right" style="color:white;">Edit Profile</h6>
                                </div>
                                <form action="profile_data.php" method="POST" enctype='multipart/form-data'>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><input type="text" class="form-control" name="firstname" placeholder="first name" value="<?= $gallery['firstname'] ?>"></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="lastname" value="<?= $gallery['lastname'] ?>" placeholder="Doe"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><input type="text" class="form-control" name="username" placeholder="username" value="<?= $gallery['username'] ?>"></div>
                                        <div class="col-md-6"><input type="email" class="form-control" name="email" value="<?= $gallery['email'] ?>" placeholder="email"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><input type="text" class="form-control" name="address" placeholder="address" value="<?= $gallery['alamat'] ?>"></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="no_hp" value="<?= $gallery['no_hp'] ?>" placeholder="telephone"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><input type="password" name="password" class="form-control" placeholder="password"></div>
                                        <div class="col-md-6"><input type="file" class="form-control" name="my_image"></div>
                                    </div>
                                    <div class="mt-5 text-right"><button class="btn profile-button" style="color:white;" name="submit">Save Profile</button></div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>




        <?php
                // close while loop 
            }
        }
        ?>
    </div>
</body>

</html>