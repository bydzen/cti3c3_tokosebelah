<?php
include 'add.php';
include '../Config/header-user.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0 shrink-to-fit=no">
    <title>Add To | Toko Sebelah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/add.css">
</head>

<body style="background-color: #22272B;">
    <div class="super_container">
        <header class="header" style="display: none;">
            <div class="header_main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="single_product">
            <div class="container-fluid" style=" background-color: ##22272B; padding: 11px;">
                <div class="row">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['error']; ?>
                        </div>
                    <?php } ?>
                    <div class="col-lg-4 order-lg-2 order-1">
                        <div class="image_selected"><img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"'; ?>>
                        </div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <div class="product_name" value="<?= $row['produk_name'] ?>"><?= $row['produk_name'] ?></div>
                            <div class="product-rating"></div>
                            <div> <span class="product_price" value="<?= number_format($row['price']) ?>">RP. <?= number_format($row['price']) ?></span> </div>
                            <div> <span class="product_saved"></div>
                            <hr class="singleline">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="margin-bottom:50px;margin-top:10px;"> <span class="product_info"><?= $row['describe'] ?></span> </div>
                                </div>
                            </div>
                            <div class="col-md-7"> </div>
                        </div>
                        <div> <span class="product_info">Materials: <?= $row['material'] ?><span><br>
                                    <span class="product_info">Sleting: <?= $row['sleting'] ?>
                                        <span> <br>
                                            <span class="product_info">
                                                <span class="product_info">Furing: <?= $row['furing'] ?>
                                                    <span><br>
                                                        <span class="product_info">
                                                            <span class="product_info">Weight: <?= $row['weight'] ?>
                                                                <span>

                        </div>
                        <div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-xs-6" style="margin-left: 15px;">
                                    <hr class="singleline">
                                    <div class="order_info d-flex flex-row">
                                        <form action="cart.php?action=add&id=<?php echo $row["id_produk"]; ?>" method="post">
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6" style="margin-left: 13px;">
                                            <div class="product_quantity">
                                                <span>QTY: </span>
                                                <input id="quantity" name="quantity" type="text" value="1">

                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="hidden" name="hidden_id" value="<?php echo $row["id_produk"]; ?>" />
                                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                            <button class="btn btn-primary shop_button" name="shop_button">Add to Cart</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</body>

</html>