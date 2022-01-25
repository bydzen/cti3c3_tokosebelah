<?php
include '../database/session.php';
include '../Config/header-user.php';

error_reporting(0);



if (isset($_POST['shop_button'])) {
    $id = mysqli_real_escape_string($conn, $_POST['hidden_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['hidden_price']);


    $sql2 = mysqli_query($conn, "INSERT INTO cart (id_cart, id_user, id_produk, quantity, price)
            VALUES ('$loggedin_id','$loggedin_id', '$id', '$quantity', '$price')");
    if ($sql2) {
        echo "<script>alert('Tambah Produk berhasil!')</script>";

        echo "<script>document.location.href = 'cart.php';</script>";
    } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
        echo "<script>document.location.href = 'gallery.php';</script>";
    }
}


if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $sql = "SELECT * FROM `produk` NATURAL JOIN `cart` NATURAL JOIN `user` WHERE id_user='$loggedin_id'";
        $res = mysqli_query($conn,  $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($values = mysqli_fetch_assoc($res)) {

                if ($values["id_order"] == $_GET["id"]) {
                    $ide = $_GET["id"];
                    $sql2 = mysqli_query($conn, "DELETE FROM cart where id_order = '$ide'");
                    if ($sql2) {
                        echo "<script>alert('Hapus Produk berhasil!')</script>";

                        echo "<script>document.location.href = 'cart.php';</script>";
                    } else {
                        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                        echo "<script>document.location.href = 'cart.php';</script>";
                    }
                }
            }
        }
    }
}

//If you have use Older PHP Version, Please Uncomment this function for removing error 

/*function array_column($array, $column_name)
{
	$output = array();
	foreach($array as $keys => $values)
	{
		$output[] = $values[$column_name];
	}
	return $output;
}*/
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.tabledit.js"></script>
    <script type="text/javascript" src="custom_table_edit.js"></script>

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
                                    <th scope="col" class="text-right d-none d-md-block" width="200"></th>
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
                                                    <input id="quantity" name="quantity" type="text" value="<?php echo number_format($values["quantity"]); ?>" disabled>
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
                                            <td class="text-right d-none d-md-block"> <a href="cart.php?action=delete&id=<?php echo $values["id_order"]; ?>" class="btn btn-danger" data-abc="true"> Remove</a> </td>
                                        </tr>


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

                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align text-white">
                            <dt>Total price:</dt>
                            <dd class="text-right text-white ml-3">RP. <?php echo number_format($total); ?></dd>
                        </dl>
                        <dl class="dlist-align text-white">
                            <dt>Shipping fee:</dt>
                            <dd class="text-right text-danger ml-3">FREE</dd>
                        </dl>

                        <a href="payment.php" class="btn  btn-success btn-square btn-main mt-2" data-abc="true">Checkout</a>
                        <a href="home.php" class="btn  btn-Dark btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</body>
<script>
    function deleteData(str) {
        var id = str;
        $.ajax({
            type: "POST",
            url: "purchase.php?action=del",
            data: "id_order" + id
        });
    }
</script>

</html>