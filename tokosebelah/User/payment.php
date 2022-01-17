<?php
include '../database/session.php';
include '../config/header-user.php';

error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0 shrink-to-fit=no">
    <title>Edit Product | Toko Sebelah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/edit.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/add.css">

</head>

<body style="background-color: #22272B;">

    <!-- Edit Product -->
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-9">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $sql = "SELECT * FROM `produk` NATURAL JOIN `cart` NATURAL JOIN `user` WHERE id_user='$loggedin_id'";
                                $res = mysqli_query($conn,  $sql);

                                if (mysqli_num_rows($res) > 0) {
                                    while ($values = mysqli_fetch_assoc($res)) {  ?>
                                        <tr>
                                            <td>

                                                <form action="purchase.php" method="post">
                                                    <input type="hidden" name="hidden_idorder[]" value="<?php echo $values['id_order']; ?>" />
                                                    <input type="hidden" name="hidden_id[]" value="<?php echo $values['id_produk']; ?>" />
                                                    <input type="hidden" name="hidden_address[]" value="<?php echo $values["alamat"] ?>" />
                                                    <input type="hidden" name="hidden_hp[]" value="<?php echo $values["no_hp"] ?>" />
                                                    <figure class="itemside align-items-center">
                                                        <div class="aside"><img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($values['image']) . '"'; ?> class="img-sm"></div>
                                                        <figcaption class="info"> <a name="idproduk" href="addto.php?id=<?php echo $values["id_produk"]; ?>" class="title text-white" data-abc="true"><?php echo $values["produk_name"]; ?></a>
                                                            <p class="text-muted small">Size: M <br> Brand: TOKOSEBELAH <br> Color: Cream</p>
                                                        </figcaption>
                                                    </figure>
                                            </td>
                                            <td>
                                                <div class="product_quantity">
                                                    <span>QTY: </span>
                                                    <input id="quantity" name="quantity[]" type="text" value="<?php echo number_format($values["quantity"]); ?>" disabled>
                                                    <input type="hidden" name="hidden_quantity[]" value="<?php echo number_format($values["quantity"]); ?>" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var class="price text-white" value="<?php echo $values["price"]; ?>" style="font-style:normal;">
                                                        RP. <?php echo number_format($total_price = $values["quantity"] * $values["price"]); ?>

                                                        <input type="hidden" name="total_price[]" value="<?php echo $total_price ?>" />
                                                    </var>
                                                </div>
                                            </td>
                                    <?php
                                        $total = $total + $values["quantity"] * $values["price"];
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">

                <?php
                $sql4 = "SELECT * FROM admin";
                $resadmin = mysqli_query($conn,  $sql4);

                if (mysqli_num_rows($resadmin) > 0) {
                    while ($admin = mysqli_fetch_assoc($resadmin)) {  ?>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align text-white">
                                    <dt>QR Code Pembayaran QRIS</dt>
                                </dl>
                                <img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($admin['payment']) . '"'; ?> class="img-sm" style="width:250px;height:auto;">
                                <dl class="dlist-align text-white" style="margin-top:20px;">
                                    <dt>Total price:</dt>
                                    <dd class="text-right text-white ml-3">RP. <?php echo number_format($total); ?></dd>
                                </dl>
                                <dl class="dlist-align text-white">
                                    <dt>Shipping fee:</dt>
                                    <dd class="text-right text-danger ml-3">FREE</dd>
                                </dl>
                                <button type="submit" name="submit" onclick="deleteData(<?php echo $values['id_order'] ?>)" class="btn btn-success btn btn-main"> Make Purchase </button>
                                <a href="home.php" class="btn  btn-Dark btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>

                            </div>
                        </div>
                <?php }
                } ?>
            </aside>
        </div>
    </div>
</body>

</html>