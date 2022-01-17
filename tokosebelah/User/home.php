<?php include '../database/config.php'; ?>
<?php include '../Config/header-user.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0 shrink-to-fit=no">
    <title>Home | Toko Sebelah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- owl carousel css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&family=Reenie+Beanie&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/home.css">
</head>

<body style="background-color: #22272B;">
    <!-- home -->
    <div class="home" style="background-image: url(../assets/img/background.png)">
        <h1 class="text">New Bag Collection</h1>
        <center><button href="" class="tbl-shop">Shop Now</button></center>
    </div>

    <!-- Best Seller -->

    <div class="title1" style="margin-left:32%;">Best Seller</div>
    <div class="post-container owl-carousel">
        <?php
        $sql = "SELECT * FROM produk ORDER BY id_produk ASC LIMIT 6";
        $res = mysqli_query($conn,  $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($gallery = mysqli_fetch_assoc($res)) {  ?>
                <div class="post bg-dark text-white">
                    <div class="image">
                        <a href="addto.php?id=<?= $gallery['id_produk'] ?>"><img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($gallery['image']) . '"'; ?> alt="bag" height="300" width="500"></a>
                    </div>
                    <div class="content">
                        <div class="sold" style="margin-top:19px"></div>
                        <a href="addto.php?id=<?= $gallery['id_produk'] ?>" class="title" style="margin-bottom:302px;"><?= $gallery['produk_name'] ?></a>
                        <h3>RP. <?= number_format($gallery['price']) ?></h3>
                        <a href="addto.php?id=<?= $gallery['id_produk'] ?>" class="tbl-add">Add to Cart</a>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <div class="title1" style="">All Produk</div>
    <div class="container-fluid">
        <input type="text" class="form-control" name="search" id="search" placeholder="Search..." style="width:200px;margin-left:955px;">
        <div class="row" id="result" style="margin-left:150px">


        </div>
        <!-- Jquery cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Owl Carousel js cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.post-container').owlCarousel({
                    pagination: false,
                    autoplay: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        700: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        },
                        1200: {
                            items: 4
                        },
                    }
                })
                load_data();

                function load_data(query) {
                    $.ajax({
                        url: "home_fetch.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                }
                $('#search').keyup(function() {
                    var search = $(this).val();
                    if (search != '') {
                        load_data(search);
                    } else {
                        load_data();
                    }
                });
            });
        </script>
</body>

</html>