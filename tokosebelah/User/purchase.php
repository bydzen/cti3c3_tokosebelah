<?php
 include '../database/session.php';
  
 if (isset($_POST['submit'])) {

    $id = $_POST['hidden_idorder'];
    $id_produk = $_POST['hidden_id'];
    $quantity = $_POST['hidden_quantity'];
    $address = $_POST['hidden_address'];
    $no_hp = $_POST['hidden_hp'];
    $harga = $_POST['total_price'];
    $date = date('Y-m-d'); 

    $sql = "SELECT id_cart from cart where id_user='$loggedin_id'";
    $res = mysqli_query($conn,  $sql);
        $jumlah = mysqli_num_rows($res);
        
    foreach($id as $index => $ids){
        
        $s_ids = $ids;
        $s_idproduk = $id_produk[$index];
        $s_quantity = $quantity[$index];
        $s_address = $address[$index];
        $s_hp = $no_hp[$index];
        $s_harga = $harga[$index];

        $sql23 = mysqli_query($conn, "INSERT INTO `order` (id_produk, id_order, id_user, order_date, quantity, total_price, address, phone_number)
                  VALUES ('$s_idproduk', '$s_ids', '$loggedin_id', ' $date', '$s_quantity', '$s_harga', '$s_address', '$s_hp')");
                 
        $sql3 = mysqli_query($conn, "DELETE FROM `cart` WHERE id_order='$s_ids'");
    }
     if ($sql23) {
          
            echo "<script>alert('Pesanan berhasil dimasukkan, Terimakasih')</script>";
            echo "<script>document.location.href = 'orders.php';</script>";   
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            echo "<script>document.location.href = 'cart2.php';</script>";
        }
        
}
?>